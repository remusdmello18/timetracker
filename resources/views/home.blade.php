@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                {{-- <a class="btn btn-danger float-end" href="{{ route('record.exporttocsv') }}">Export Record Data</a> --}}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}

                     
                       <h1>Record based on Date</h1>
                       
                       <table class="table"> 
                        <tr>
                            <th>Date</th>
                            <th>Time</th>                           
                        </tr>                      
                        <tbody>
                          
                            @foreach($records as $key => $value)                              
                                   <tr>
                                    <td>{{ $value }}</td>

                                    <td>{{ $key }}</td>
                                                                 
                                   </tr>
                               @endforeach
                               
                        </tbody>
                       </table>
                       <canvas id="myChart" height="100px"></canvas>

                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
  
    function drawChart() {
  
    var data = google.visualization.arrayToDataTable([
        ['date', 'diff'],
  
            @php
                foreach($records as $key => $value) {
                    echo "['".$value."', ".$key."],";
                }
            @endphp
    ]);
  
    var options = {
      title: 'Worked according to days',
      curveType: 'function',
      legend: { position: 'bottom' }
    };
  
      var chart = new google.visualization.LineChart(document.getElementById('myChart'));
  
      chart.draw(data, options);
    }
</script>
@endsection
