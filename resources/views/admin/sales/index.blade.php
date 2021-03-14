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
            <form action="{{ route('admin.sales.delete', ['id' => $transaction->id]) }}" method="POST" style="display: inline-block;">
              @method('delete')
              @csrf
              <button type="submit" class="btn btn-danger" value="Delete" onclick="return confirm('Delete Data?')">
                <i class="fa fa-trash" title="Delete"></i>
              </button>
            </form>
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