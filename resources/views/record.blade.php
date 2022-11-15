@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                {{-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div> --}}
                <span>&nbsp;</span>
                
                    <h5>   {{ Auth::user()->name }} <h5>
                        {{-- <a class="btn btn-danger float-end" href="{{ route('recordexport.export') }}">Export Record Data</a> --}}
                        @csrf
                        <table class="table">
                         <tr>
                             <th>Task</th>
                             <th>In Time</th>
                             <th>Out Time</th>
                             <th>Date</th>
                             <th>Delete</th>
                         </tr>
                         <tbody id="tbody">
                            @if(count($data) > 0)

				                @foreach($data as $row)
                                    <tr>
                                        <td>{{ $row->task }}</td>
                                        <td>{{ $row->intime }}</td>
                                        <td>{{ $row->outtime }}</td>
                                        <td>{{ $row->date }}</td>
                                        <td>
                                    <form action="{{ route('record.destroy', $row->id) }}" method="POST">
                                        @csrf
								        @method('DELETE')
                                        <input type="submit"  value="Delete" />
                                            <a href="{{ route('record.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            {{-- <button type="Submit" class="delete" id="delete" name="delete">Delete</button> --}}
                                        
                                    </form>
                                </td>
                                    </tr>
                                @endforeach
                                @endif
                         </tbody>
                        </table> 
                        <a href="{{ route('record.create') }}" class="btn btn-success float-center">Add</a>                        
                
               
                   

            </div>
        </div>
    </div>
</div>
@endsection



