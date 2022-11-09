<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Auth;

class RecordExport extends Model
{
    use HasFactory;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $userid=Auth::user()->id;
        return DB::select("select * from records where user_id='$userid'");
    }
    /**
     * 
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            'task',
            'intime',
            'outtime',
            'date'
        ];
    }
}
