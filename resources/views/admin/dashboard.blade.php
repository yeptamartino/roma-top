@extends('layouts.master')
@section('subtitle')
Dashboard
@endsection
@section('content')
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3 style="font-size:25px;">@rupiah($sales_this_month)</h3>
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
            <h3 style="font-size:25px;">{{$transactions_count_this_month}}</h3>
            <p>Total Transaksi Bulan Ini</p>
          </div>
          <div class="icon">
            <i class="fa fa-money"></i>
          </div>
          <a href="{{route('admin.report.sales')}}" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3 style="font-size:25px;">{{$sold_items_count}}</h3>
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
            <h3 style="font-size:25px;">{{$total_customer}}</h3>
            <p>Total Pelanggan</p>
          </div>
          <div class="icon">
            <i class="fa fa-user"></i>
          </div>
          <a href="{{route('admin.report.sales')}}" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Daftar Katalog</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table id="catalog" class="table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Harga Modal</th>
                <th>Harga Penjualan</th>
              </tr>
            </thead>
            <tbody>
              @if(count($catalogs) > 0)
              @foreach($catalogs as $catalog)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $catalog->name }}</td>
                <td>{{ $catalog->category->name }}</td>
                <td>{!! $catalog->description !!}</td>
                <td>@rupiah($catalog->capital_price)</td>
                <td>
                  <ul>
                    @foreach($catalog->prices as $price)
                      <li>[{{ $price->name }}] - @rupiah($price->price) </li>
                    @endforeach
                  </ul>
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
    </div>
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">History Transaksi</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12 table-responsive">
              <table id="history" class="table">
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
                    <td>{{ $transaction->created_at->format('d, M Y') }}</td>
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
        </div>
      </div>

  @endsection

@push('styles')
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />
@endpush

  @push('scripts')
  <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#catalog').DataTable();
    });
  </script>
   <script>
    $(document).ready(function() {
      $('#history').DataTable();
    });
  </script>
  @endpush