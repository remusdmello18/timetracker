<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecordExport;
use Maatwebsite\Excel\Facades\Excel;

class RecordExportController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function index()
    {
        $record = Record::get();
  
        return view('recordexport', compact('record'));
    }
        
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        Excel::download(new RecordExport, 'Record.xlsx');
        return view('home');
    }      
   
}
