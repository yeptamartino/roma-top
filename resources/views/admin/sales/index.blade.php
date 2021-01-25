@extends('layouts.master')


@section('subtitle')
Daftar Transaksi Penjualan
@endsection

@section('content')
<form method="get" action="{{route('admin.sales')}}">
<div class="row">
  <div class="col-md-3">
      <div class="form-group">
          <label>Dari Tanggal</label>
          <input type="date" class="form-control" name="tgl_awal" value="{{ request()->get('tgl_awal') ?? date("y-m-d") }}">
      </div>
  </div>

  <div class="col-md-3">
      <div class="form-group">
          <label>Sampai Tanggal</label>
          <input type="date" class="form-control" name="tgl_akhir" value="{{  request()->get('tgl_akhir') ?? date("y-m-d") }}">
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <label>Pencarian</label>
      <input type="text" class="form-control" name="keyword" value="{{  request()->get('keyword') ?? '' }}" placeholder="No. Transaksi">
      </div>
  </div>
  <div class="col-md-3" style="margin-top: 25px;">
      <div class="form-group">
          <input type="submit" name="action" value="Cari" class="btn btn-info" title="Pencarian">
          <input type="submit" name="action" value="Excel" class="btn btn-success" title="Excel">
          <input type="submit" name="action" value="Pdf" class="btn btn-warning" title="Pdf">
          <a href="{{route('admin.sales')}}" class="btn btn-danger "> <i class="fa fa-refresh" title="Refresh"></i></a>
      </div>
  </div>
</div>
</form>
@if(Session::has('error'))
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger" role="alert">
        {!! Session::get('error') !!}
      </div>
    </div>
  </div>
@endif
@if(Session::has('success'))
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-info" role="alert">
        {!! Session::get('success') !!}
      </div>
    </div>
  </div>
@endif
<div class="row">
  <div class="col-md-12 table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>No Nota.</th>
          <th>Tgl.</th>
          <th>Nama Plgn.</th>
          <th>Total Hrg. Modal</th>
          <th>Total Hrg. Jual</th>
          <th>Total Diskon</th>
          <th>Total Transaksi</th>
          <th>Total Bayar</th>
          <th>Kembalian</th>
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
          <td>@rupiah($transaction->total_capital_price())</td>
          <td>@rupiah($transaction->total_selling_price())</td>
          <td>@rupiah($transaction->total_discount())</td>
          <td>@rupiah($transaction->total_price())</td>
          <td>@rupiah($transaction->total_paid)</td>
          <td>@rupiah($transaction->change())</td>
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

@endsection