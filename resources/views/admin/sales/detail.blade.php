@extends('layouts.master')


@section('subtitle')
Detail Transaksi #{{ $transaction->id }}
@endsection

@section('content')
<div class="row">
  <div class="col-md-12 table-responsive">
    <table class="table">
      <tbody>
        <tr>
          <td><b>No. Nota</b></td>
          <td>#{{ $transaction->id }}</td>
        </tr>
        <tr>
          <td><b>Nama Plgn.</b></td>
          @if($transaction->customer)
            <td>{{ $transaction->customer->name }}</td>
          @else
            <td>-</td>
          @endif
        </tr>
        <tr>
          <td><b>No Hp. Plgn.</b></td>
          @if($transaction->customer)
          <td>{{ $transaction->customer->phone }}</td>
        @else
          <td>-</td>
        @endif
        </tr>
        <tr>
          <td><b>Tgl.</b></td>
          <td>{{ $transaction->created_at }}</td>
        </tr>
        <tr>
          <td><b>Total Hrg. Modal</b></td>
          <td>@rupiah($transaction->total_capital_price())</td>
        </tr>
        <tr>
          <td><b>Total Hrg. Jual</b></td>
          <td>@rupiah($transaction->total_selling_price())</td>
        </tr>
        <tr>
          <td><b>Laba Bersih</b></td>
          <td>@rupiah($transaction->total_selling_price() - $transaction->total_capital_price())</td>
        </tr>
        <tr>
          <td><b>Total Diskon</b></td>
          <td>-@rupiah($transaction->total_discount())</td>
        </tr>
        <tr>
          <td><b>Total Transaksi</b></td>
          <td>@rupiah($transaction->total_price())</td>
        </tr>
        <tr>
          <td><b>Total Bayar</b></td>
          <td>@rupiah($transaction->total_paid)</td>
        </tr>
        <tr>
          <td><b>Kembalian</b></td>
          <td>@rupiah($transaction->change())</td>
        </tr>
        <tr>
          <td><b>Metode Pembayaran</b></td>
          <td>{{ $transaction->payment_method }}</td>
        </tr>
      </tbody>
    </table>    
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <h4>Item Yang Dibeli</h4>
  </div>
</div>
<div class="row">
  <div class="col-md-12 table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Nama</th>          
          <th>Hrg. Modal</th>
          <th>Hrg. Jual</th>
          <th>Jumlah</th>
          <th>Hrg. Total Modal</th>
          <th>Hrg. Total Penjualan</th>
          <th>Untung Bersih</th>
        </tr>
      </thead>
      <tbody>
        @foreach($transaction->transaction_items as $item)
          <tr>
            <td>{{ $item->name }}</td>
            <td>@rupiah($item->capital_price)</td>
            <td>@rupiah($item->selling_price)</td>
            <td>{{ $item->quantity }}</td>
            <td>@rupiah($item->quantity * $item->capital_price)</td>
            <td>@rupiah($item->quantity * $item->selling_price)</td>
            <td>@rupiah(($item->quantity * $item->selling_price) - ($item->quantity * $item->capital_price))</td>
          </tr>
        @endforeach
      </tbody>
    </table>    
  </div>
</div>
@endsection