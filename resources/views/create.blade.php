@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
               
                <div class="card-header">Add Record</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('record.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Task</label>
                            <div class="col-sm-10">
                                <input type="text" name="task" class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">In Time</label>
                            <div class="col-sm-10">
                                <input type="time" name="intime" class="form-control" id="intime"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-label-form">Out Time</label>
                            <div class="col-sm-10">
                                <input type="time" name="outtime" class="form-control" id="outtime"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-label-form">Date</label>
                            <div class="col-sm-10">
                                <input type="date" name="date" class="form-control" id="date"/>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Save" />
                        </div>	
                    </form>
                </div>
            </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('timescripts')
<script>
// var items = 0;
//     function addItem() {
//         items++;
 
        // var html = "<tr>";
        // html+="<td><input type='text' name='task'></td>";
        // html+="<td><input type='time' name='intime'></td>";
        // html+="<td><input type='time' name='outtime'></td>";
        // html+="<td><input type='date' name='date'></td>";
        // html += "<td><button type='button' onclick='deleteRow(this);'>Delete</button></td>"
        // html += "</tr>";
 
        // var row = document.getElementById("tbody").insertRow();
        // row.innerHTML = html;
    }
 
// function settime(input) { 
//     const d = new Date();
//     var intimevalue = document.getElementById("intime").value;
//     document.getElementById("outtime").value = intimevalue.setMinutes(d.getMinutes()+10);    
// }

// $(function () {           

//         $("#intime").change(function() {
            
//             $('#outtime'). timepicker({'disableTimeRanges':['intime', 14:00:00]})

//         });
</script>
@endsection

