@extends('layouts.master')
@section('subtitle')
Dashboard
@endsection
@section('content')
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{$catalog_count}}</h3>
            <p>Total Katalog</p>
          </div>
          
          <div class="icon">
            <i class="fa fa-pie-chart"></i>
          </div>
        <a href="{{route('admin.catalog')}}" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{$category_count}}</h3>
            <p>Total Kategori</p>
          </div>
          <div class="icon">
            <i class="fa  fa-list"></i>
          </div>
          <a href="{{route('admin.category')}}" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{$stock_count}}</h3>
            <p>Total Stok</p>
          </div>
          <div class="icon">
            <i class="fa fa-database"></i>
          </div>
        <a href="{{route('admin.stock')}}" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{$user_count}}</h3>
            <p>Total Admin</p>
          </div>
          <div class="icon">
            <i class="fa fa-user"></i>
          </div>
          <a href="{{route('admin.admin')}}" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Top 10 Sales</h3>
        <x-button-close></x-button-close>
      </div>
      <div class="box-body">
        <table class="table table-bordered">
          <tr>
            <th style="width: 10px">#</th>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Total Belanja</th>
          </tr>
         
        </table>
      </div>
    </div>
   
   
  @endsection