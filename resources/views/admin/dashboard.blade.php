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
    <x-filters searchPlaceholder="Masukkan Nama Pelanggan" :disableExports="true" :disableDates="true" />
    <div class="row">
      <div class="col-md-12 table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>No Nota.</th>
              <th>Tgl.</th>
              <th>Nama Plgn.</th>
              <th>Total Transaksi</th>
              <th>Total Bayar</th>
              <th>Item Transaksi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if(count($transactions) > 0)
            @foreach($transactions as $transaction)
            <tr>
              <td>#{{ $transaction->id }}</td>
              <td>{{ $transaction->created_at }}</td>
              @if($transaction->customer)
                <td>{{ $transaction->customer->name }}</td>
              @else
                <td>-</td>
              @endif
              <td>@rupiah($transaction->total_price())</td>
              <td>@rupiah($transaction->total_paid)</td>
              <td>
                <ul>
                  @foreach($transaction->transaction_items as $transaction_item)
                    <li>{{ $transaction_item->name }} ({{$transaction_item->quantity}} x @rupiah($transaction_item->selling_price))</li>
                  @endforeach
                </ul>
              </td>
              <td>
                  <a
                  href="{{ route('admin.sales.detail', ['id' => $transaction->id]) }}"
                  class="btn btn-primary"
                  >
                  <i class="fa fa-eye"></i>
                </a>
              </td>
        </tr>
        @endforeach
        @else
          <tr>
            <td colspan="4">
            Belum Ada Data.
            </td>
          </tr>
        @endif
      </tbody>
      </table>    
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        {{ $transactions->appends(request()->except('page'))->links('pagination.bootstrap3') }}
      </div>
    </div>
  @endsection