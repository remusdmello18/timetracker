@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
               
                <div class="card-header">Add Record</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('record.update', $record->id) }}" enctype="multipart/form-data">
                        @csrf
			            @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Task</label>
                            <div class="col-sm-10">
                                <input type="text" name="task" class="form-control" value="{{$record->task}}"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">In Time</label>
                            <div class="col-sm-10">
                                <input type="time" name="intime" class="form-control" value="{{$record->intime}}"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-label-form">Out Time</label>
                            <div class="col-sm-10">
                                <input type="time" name="outtime" class="form-control" value="{{$record->outtime}}"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-label-form">Date</label>
                            <div class="col-sm-10">
                                <input type="date" name="date" class="form-control" value="{{$record->date}}"/>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="hidden" name="hidden_id" value="{{ $record->id }}" />
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

