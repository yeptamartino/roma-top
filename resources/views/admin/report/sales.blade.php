@extends('layouts.master')
@section('subtitle')
Laporan Penjualan
@endsection
@section('content')
<form method="get" action="{{route('admin.sales')}}">
  <div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Dari Tanggal</label>
            <input type="date" class="form-control" name="tgl_awal" value="{{ request()->get('tgl_awal') ?? $default_tgl_awal->format('Y-m-d') }}">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Sampai Tanggal</label>
            <input type="date" class="form-control" name="tgl_akhir" value="{{  request()->get('tgl_akhir') ?? $default_tgl_akhir->format('Y-m-d') }}">
        </div>
    </div>
  </div>
</form>
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h4>@rupiah($laba_kotor)</h4>
        <p>Laba Kotor</p>
      </div>
      
      <div class="icon">
        <i class="fa fa-money"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
      <h4>@rupiah($laba_bersih)</h4>
        <p>Laba Bersih</p>
      </div>
      <div class="icon">
        <i class="fa  fa-money"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-yellow">
      <div class="inner">
        <h4>@rupiah($total_diskon)</h4>
        <p>Total Diskon</p>
      </div>
      <div class="icon">
        <i class="fa fa-money"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-olive">
      <div class="inner">
        <h4>@rupiah($total_transaksi)</h4>
        <p>Total Transaksi</p>
      </div>
      <div class="icon">
        <i class="fa fa-money"></i>
      </div>
    </div>
  </div>
</div>

<div class="box">
  <div class="box-header with-border">
    <h4 class="box-title">Penjualan Per Hari</h4>
    <x-button-close></x-button-close>
  </div>
  <div class="box-body">
    <div class="chart">
      <canvas id="lineChart" style="height:250px"></canvas>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('adminlte/bower_components/chart.js/Chart.js')}}"></script>
<script>
  var areaChartData = {
      labels  : @json($transaction_date_labels),
      datasets: [
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                :  @json($transaction_date_values)
        }
      ]
    }

    console.log(areaChartData);

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
    var lineChart                = new Chart(lineChartCanvas)
    var lineChartOptions         = areaChartOptions
    lineChartOptions.datasetFill = false
    lineChart.Line(areaChartData, lineChartOptions)
</script>
@endpush