@extends('layouts.master')
@section('subtitle')
Dashboard
@endsection
@section('content')
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>@rupiah($sales_this_month)</h3>
            <p>Penjualan Bulan Ini</p>
          </div>
          
          <div class="icon">
            <i class="fa fa-pie-chart"></i>
          </div>
        <a href="{{route('admin.report.sales')}}" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{$transactions_count_this_month}}</h3>
            <p>Total Transaksi Bulan Ini</p>
          </div>
          <div class="icon">
            <i class="fa  fa-pie-chart"></i>
          </div>
          <a href="{{route('admin.report.sales')}}" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{$sold_items_count}}</h3>
            <p>Total Item Terjual Bulan Ini</p>
          </div>
          <div class="icon">
            <i class="fa fa-database"></i>
          </div>
        <a href="{{route('admin.report.sales')}}" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{$total_customer}}</h3>
            <p>Total Pelanggan</p>
          </div>
          <div class="icon">
            <i class="fa fa-user"></i>
          </div>
          <a href="{{route('admin.report.sales')}}" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  @endsection