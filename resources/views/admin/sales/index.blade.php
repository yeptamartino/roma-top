@extends('layouts.master')


@section('subtitle')
Daftar Transaksi Penjualan
@endsection

@section('content')
<x-filters searchPlaceholder="No. Transaksi" />
<x-alert />
<div class="row">
  <div class="col-md-12 table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>No Nota.</th>
          <th>Tgl.</th>
          <th>Nama Plgn.</th>
          {{-- <th>Total Hrg. Modal</th> --}}
          <th>Total Hrg. Jual</th>
          <th>Total Diskon</th>
          <th>Total Transaksi</th>
          <th>Total Bayar</th>
          <th>Kembalian</th>
          <th>Status</th>
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
          {{-- <td>@rupiah($transaction->total_capital_price())</td> --}}
          <td>@rupiah($transaction->total_selling_price())</td>
          <td>@rupiah($transaction->total_discount())</td>
          <td>@rupiah($transaction->total_price())</td>
          <td>@rupiah($transaction->total_paid)</td>
          <td>@rupiah($transaction->change())</td>
          <td>
            @if($transaction->status == 'SUCCESS')
              <small class="label bg-green">BERHASIL</small>
            @else
              <small class="label bg-red">BATAL</small>
            @endif
          </td>
          <td>
            <a href="{{ route('admin.sales.canceled', ['id' => $transaction->id]) }}" class="btn btn-danger" title="Batalkan Transaksi">
              <i class="fa fa-close"></i>
            </a>

            <a href="{{ route('admin.sales.detail', ['id' => $transaction->id]) }}" class="btn btn-primary" title="Detail Transaksi">
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