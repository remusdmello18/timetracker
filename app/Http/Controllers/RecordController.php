<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RecordController extends Controller
{
    //
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userid=Auth::user()->id;
        $data = DB::select("select * from records where user_id='$userid'");
        return view('record', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
        //return view('record');
        //return DB::select("select * from records where user_id='$userid'");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req){
        $record = new Record;
        $record->task=$req->task;
        $record->intime=$req->intime;
         $record->outtime=$req->outtime;              
        $record->date=$req->date;
        $record->user_id=Auth::user()->id;
        $record->save();
        return redirect()->route('record')->with('success', 'Record added Successfully');
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        $record->delete();

        return redirect()->route('record')->with('success', 'Record deleted Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        return view('edit', compact('record'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    { 

        $record = Record::find($request->hidden_id);

        $record->task = $request->task;

        $record->intime = $request->intime;

        $record->outtime = $request->outtime;

        $record->date = $request->date;

        $record->updated_at = Carbon::now();

        $record->save();

        return redirect()->route('record')->with('success', 'record Data has been updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        $userid=Auth::user()->id;
        // $dt = DB::select("select * from records where user_id='$userid' order by date");
        // $dates;
        // $valuesfordates;
        // // $commondates = DB::select("select * from records where user_id='$userid' group by date");  
        // foreach($dt as $row)
        // {
        //     $commondate=$row->date;
        //     $valueadded = 0 ;
        //     foreach($dt as $val)
        //     {
        //         if($row->date == $val->date)
        //         {
        //             //$mins = ($val->intime - $val->outtime) / 60;
        //             $mins = ((strtotime($val->intime) - strtotime($val->outtime) )/60)/60;
        //             $valueadded = $valueadded + $mins;
                    
        //         }
        //         else
        //         {
        //             exit();
        //         }
        //     }
        //     $dates = array_push($commondate);
        //     $valuesfordates = array_push($valueadded);

        // }

        //return view('home', compact('dates'))->with(compact('valuesfordates'));
        //return view('home', compact('dt'))->with('i', (request()->input('page', 1) - 1) * 5);



        $records = Record::selectRaw("date, TIMEDIFF(outtime,intime) as diff")
                    ->where('user_id', $userid) 
                    ->groupBy("date","outtime","intime") 
                    ->having("diff", ">" , 0)
                    ->get()                  
                    ->pluck('date', 'diff');
                    //->toaraay();

        // $dt = DB::select("select date, TIMEDIFF(outtime,intime) as diff from records where user_id='$userid' group by date,outtime,intime");
 
        // $labels = $records->keys();
        // $data = $records->values();
              
        // return view('home', compact('labels', 'data'));

        return view('home', compact('records'));
    }

    

     /**
     * export the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function exporttocsv(Record $record)
    {
        $userid=Auth::user()->id;
        $query = DB::select("select * from records where user_id='$userid' order by date"); 
 
         
            $delimiter = ","; 
            $filename = "record" . date('Y-m-d') . ".csv"; 
             
            // Create a file pointer 
            $f = fopen('php://memory', 'w'); 
             
            // Set column headers 
            $fields = array('ID', 'Task', 'In Time', 'Out Time', 'Date', 'Created', 'Updated', 'Deleted', 'User_Id'); 
            fputcsv($f, $fields, $delimiter); 
             
            // Output each row of the data, format line as csv and write to file pointer 
            foreach($query as $row){ 
                $user = Auth::user()->name; 
                $lineData = array($row->id, $row->task, $row->intime, $row->outtime, $row->date, $row->created_at, $row->updated_at,$row->deleted_at, $user); 
                fputcsv($f, $lineData, $delimiter); 
            } 
             
            // Move back to beginning of file 
            fseek($f, 0); 
             
            // Set headers to download file rather than displayed 
            header('Content-Type: text/csv'); 
            header('Content-Disposition: attachment; filename="' . $filename . '";'); 
             
            //output all remaining data on a file pointer 
            fpassthru($f); 

            return redirect()->route('home')->with('success', 'Export successful');
       
    }
}

