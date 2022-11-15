@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}

                     
                       {{-- <h1>Record based on Date</h1> --}}
                       
                       {{-- <table class="table"> 
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
                       </table> --}}
                       {{-- <div id="myChart" height="100px"></div> --}}


                       <div id="curve_chart" style="height: 500px"></div>

                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Date', 'Difference'],  
            <?php echo $datas; ?>
        ]);


        var options = {
          title: 'Record based on Date',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
</script>

@endsection
