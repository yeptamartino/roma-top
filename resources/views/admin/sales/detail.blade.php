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
        <tr>
          <td><b>Catatan</b></td>
          @if($transaction->note)
          <td>{{$transaction->note }}</td>
          @else
          <td>-</td>
          @endif
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
<div class="container">
  <div class="row">
    <div class="col-12">
      <button type="button" class="btn btn-primary" onclick="printTransaction()">CETAK TRANSAKSI</button>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  function printTransaction()
  {
      const transaction_id = '{{ $transaction->id }}';
      const transaction_date = '{{ $transaction->created_at }}';
      const transaction_payment_method = '{{ $transaction->payment_method }}';
      const transaction_customer_name = '{{ $transaction->customer ? $transaction->customer->name : "-" }}';
      const transaction_items = @json($transaction->transaction_items);
      console.log(transaction_items[0]);
      const total_selling_price = parseInt('{{ $transaction->total_selling_price() }}');
      const total_discount = parseInt('{{ $transaction->total_discount() }}');
      const total_price = parseInt('{{ $transaction->total_price() }}');
      const total_paid = parseInt('{{ $transaction->total_paid }}');
      const total_change = parseInt('{{ $transaction->change() }}');
      const total_ongkir = parseInt('{{ $transaction->total_ongkir }}');

      var mywindow = window.open('', 'PRINT', 'height=1280,width=720');

      const printBody = `
        <html>
          <head>
            <title>TRANSAKSI_NO_${'{{ $transaction->id }}'}</title>
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
            <style>
              * {
                color: black;
                font-size: 10pt;
                font-weight: bold;
                font-family: 'Poppins', sans-serif;
              }
              body {                
                background-color: white;                
              }              
              #print-wrapper {
                width: 58mm;
                display: flex;
                flex-direction: column;                
              }
              .w-100 {
                width: 100%;
              }
            </style>
          </head>
          <body>
            <div id="print-wrapper">
              <div align="center">
                <img src="${'{{ url("/roma-top-logo.png") }}'}" width="80" height="90" />
              </div>
              <div align="center" class="w-100">
                <h2>ROMA TOP<h2>
                <p style="font-size: 9pt;">CP: 081393655455 / 085156781627</p>
              </div>  
              <table>
                <tbody>
                  <tr>
                    <td style="font-size: 9pt;">No. ${transaction_id}</td>
                    <td></td>
                    <td style="font-size: 9pt;">${transaction_date}</td>
                  </tr>    
                  <tr>
                    <td style="font-size: 9pt;">Customer</td>
                    <td style="font-size: 9pt;">:</td>
                    <td style="font-size: 9pt;">${transaction_customer_name}</td>
                  </tr>                                                 
                </tbody>
              </table>
              <p>=============================</p>
              <table>
                <thead>
                  <tr>
                    <th align="left">Item</th>
                    <th align="left">Qty.</th>
                    <th align="left">Hrg.</th>
                    <th align="left">Total</th>
                  </tr>
                </thead>
                <tbody>
                  ${transaction_items.map((item) => {
                    return `
                      <tr>
                        <td>${item.name}</td>
                        <td>${item.quantity}x</td>
                        <td>${window.formatRupiah(item.selling_price)}</td>
                        <td>${window.formatRupiah(item.quantity * item.selling_price)}</td>
                      </tr>
                    `;
                  })}
                </tbody>
              </table>
              <p>=============================</p>
              <table>
                <tbody>
                  <tr>
                    <td style="border-bottom: solid 1px black;">Subtotal</td>
                    <td style="border-bottom: solid 1px black;">${window.formatRupiah(total_selling_price)}</td>
                  </tr>                  
                  <tr>
                    <td style="border-bottom: solid 1px black;">Total Transaksi</td>
                    <td style="border-bottom: solid 1px black;">${window.formatRupiah(total_price)}</td>
                  </tr>
                  <tr>
                    <td style="border-bottom: solid 1px black;">Total Ongkir</td>
                    <td style="border-bottom: solid 1px black;">${window.formatRupiah(total_ongkir)}</td>
                  </tr>
                  <tr>
                    <td style="border-bottom: solid 1px black;">Total Diskon</td>
                    <td style="border-bottom: solid 1px black;">-${window.formatRupiah(total_discount)}</td>
                  </tr>
                  <tr>
                    <td style="border-bottom: solid 1px black;">Total Bayar</td>
                    <td style="border-bottom: solid 1px black;">${window.formatRupiah(total_paid)}</td>
                  </tr>
                  <tr>
                    <td style="border-bottom: solid 1px black;">Total Kembalian</td>
                    <td style="border-bottom: solid 1px black;">${window.formatRupiah(total_change)}</td>
                  </tr>
                  <tr>
                    <td style="border-bottom: solid 1px black;">Metode Pembayaran</td>
                    <td style="border-bottom: solid 1px black;">${transaction_payment_method}</td>
                  </tr>
                </tbody>
              </table>

              <p>Barang yang sudah dibeli, tidak bisa ditukar / dikembalikan.</p>
            </div>
          </body>
        </html>
      `;

      mywindow.document.write(printBody);
      mywindow.document.close(); // necessary for IE >= 10
      mywindow.focus(); // necessary for IE >= 10*/

      mywindow.onload = function () {
        setTimeout(() => {
          mywindow.print();
          mywindow.close();
        }, 1000);
      }      

      return true;
  }
</script>
@endpush