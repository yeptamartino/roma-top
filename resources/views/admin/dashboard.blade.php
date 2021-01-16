@extends('layouts.master')
@section('subtitle')
Dashboard
@endsection
@section('content')
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>100</h3>
            <p>Total Katalog</p>
          </div>
          
          <div class="icon">
            <i class="fa fa-star"></i>
          </div>
        <a href="" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3>2000</h3>
            <p>Total Kategori</p>
          </div>
          <div class="icon">
            <i class="fa fa-qrcode"></i>
          </div>
          <a href="" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>3000</h3>
            <p>Total Stok</p>
          </div>
          <div class="icon">
            <i class="fa fa-user"></i>
          </div>
        <a href="" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h3>1000</h3>
            <p>Total Admin</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">10 Pelanggan Terbaru</h3>
        <x-button-close></x-button-close>
      </div>
      <div class="box-body">
        <table class="table table-bordered">
          <tr>
            <th style="width: 10px">#</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Nomor KTP</th>
          </tr>
        
        </table>
      </div>
    </div>
    
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Top 10 Pelanggan</h3>
        <x-button-close></x-button-close>
      </div>
      <div class="box-body">
        <table class="table table-bordered">
          <tr>
            <th style="width: 10px">#</th>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Nomor KTP</th>
            <th>Total Scan</th>
          </tr>
         
        </table>
      </div>
    </div>
    
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Top 10 Gerai (<a href="" 
        style="font-size: 10pt;">Lihat Semua</a>)</h3>
        <div class="box-tools pull-right">
          <x-button-close></x-button-close>
        </div>
      </div>
      <div class="box-body">
        <table class="table table-bordered">
          <tr>
            <th style="width: 10px">#</th>
            <th>Kode Gerai</th>
            <th>Nama Gerai</th>
            <th>Total Scan</th>
          </tr>
        
        </table>
      </div>
    </div>

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">10 Gerai Terendah</h3>
        <div class="box-tools pull-right">
          <x-button-close></x-button-close>
        </div>
      </div>
      <div class="box-body">
        <table class="table table-bordered">
          <tr>
            <th style="width: 10px">#</th>
            <th>Kode Gerai</th>
            <th>Nama Gerai</th>
            <th>Total Scan</th>
          </tr>
        
        </table>
      </div>
    </div>
    
  @endsection