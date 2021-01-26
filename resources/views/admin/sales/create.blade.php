@extends('layouts.master')
@section('subtitle')
Buat Transaksi Penjualan
@endsection

@section('content')
  <div class="container" id="app">
  <x-alert />
  <div class="modal fade" id="modal-pick-customer">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Pilih Pelanggan</h4>
        </div>
        <div class="modal-body table-responsive">
          <table id="customers" class="table table-bordered">
            <thead>
              <tr>
                <th>Nama</th>
                <th>No. HP</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="customer in customers">
                <td>@{{ customer.name }}</td>
                <td>@{{ customer.phone }}</td>
                <td>
                  <a href="#" v-on:click="selectCustomer(customer)" data-dismiss="modal" class="btn btn-success">Pilih</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-pick-discount">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Pilih Diskon</h4>
        </div>
        <div class="modal-body table-responsive">
          <table id="discounts" class="table table-bordered">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Potongan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="discount in discounts">
                <td>@{{ discount.name }}</td>
                <td>@{{ discount.type === 'AMOUNT' ? formatRupiah(discount.amount) : `${discount.amount}%` }}</td>
                <td>
                  <a href="#" v-on:click="selectDiscount(discount)" data-dismiss="modal" class="btn btn-success">Pilih</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-pick-payment-method">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Pilih Metode Pembayaran</h4>
        </div>
        <div class="modal-body table-responsive">
          <table id="payments" class="table table-bordered">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="payment in payment_methods">
                <td>@{{ payment.name }}</td>
                <td>
                  <a href="#" v-on:click="selectPaymentMethod(payment)" data-dismiss="modal" class="btn btn-success">Pilih</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

    <div class="row">
      <div class="col-md-4">
        <div class="input-group">  
          <input placeholder="Pelanggan" class="form-control" :value="[[ selectedCustomer ? selectedCustomer.name : '' ]]" disabled>
          <span class="input-group-btn">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-pick-customer">Pilih Pelanggan</button>
          </span>
        </div>
      </div>
      <div class="col-md-4">
        <div class="input-group">  
          <input placeholder="Diskon" class="form-control" :value="[[ selectedDiscount ? selectedDiscount.name : '' ]]" disabled>
          <span class="input-group-btn">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-pick-discount">Pilih Diskon</button>
          </span>
        </div>
      </div>
      <div class="col-md-4">
        <div class="input-group">  
          <input placeholder="Metode Pembayaran" class="form-control" :value="[[ selectedPaymentMethod ? selectedPaymentMethod.name : '' ]]" disabled>
          <span class="input-group-btn">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-pick-payment-method">Pilih Metode Pembayaran</button>
          </span>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top: 1em;">
      <div class="col-md-6">
        <label>Pilih Produk</label>
      </div>
      <div class="col-md-6">
        <label>Produk Terpilih</label>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Kategori</label>
              <select class="form-control" v-model="selectedCategory">
                <option value="ALL">Semua</option>
                <option v-for="category in categories" :value="[[ category.id ]]">@{{ category.name }}</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Gudang</label>
              <select class="form-control" v-model="selectedWarehouse">
                <option v-for="warehouse in warehouses" :value="warehouse.id">@{{ warehouse.name }}</option>
              </select>
            </div>
          </div>
        </div>
        <table id="products" class="table table-bordered">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Hrg. Modal</th>
              <th>Hrg. Jual</th>
              <th>Stok</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="catalog in catalogs.filter((item) => selectedCategory === 'ALL' || selectedCategory == item.category_id)">
              <td>@{{ catalog.name }}</td>
              <td>@{{ formatRupiah(catalog.capital_price) }}</td>
              <td>@{{ formatRupiah(catalog.selling_price) }}</td>
              <td>@{{ getStock(catalog.stocks).total }}</td>
              <td>
                <a href="#." v-on:click="addToCart(catalog)" class="btn btn-success" :disabled="!getStock(catalog.stocks).total > 0">Tambahkan</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-6">  
        <div class="row">
          <div class="col-md-12 table-responsive">
            <table class="table table-bordered">
              <tr>
                <th>Nama</th>
                <th>Gudang</th>
                <th>Jml.</th>                
                <th>Hrg. Jual</th>
                <th>Hrg. Total</th>
              </tr>
              <tr v-for="cartItem in carts">
                <td>@{{ cartItem.name }}</td>
                <td>@{{ cartItem.warehouse.name }}</td>
                <td style="width: 10em;">
                  <a href="#." v-on:click="removeFromCart(cartItem)" class="btn btn-danger">-</a>
                  @{{ cartItem.quantity }}
                  <a href="#." v-on:click="addToCart(cartItem)" class="btn btn-success">+</a>
                </td>
                <td style="width: 9em;">
                  <input type="number" class="form-control" v-model="cartItem.selling_price">
                </td>
                <td>
                  @{{ formatRupiah(cartItem.quantity * cartItem.selling_price) }}
                </td>
              </tr>
              <tr v-if="!carts.length">
                <td colspan="5">Belum ada produk terpilih.</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label>Ringkasan Penjualan</label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered">
              <tr>
                <td>
                  <b>Subtotal</b>
                </td>
                <td>@{{ formatRupiah(hitungSubTotal()) }}</td>
              </tr>
              <tr>
                <td>
                  <b>
                    Diskon
                  </b>
                </td>
                <td>-@{{ formatRupiah(hitungHargaDiskon()) }}</td>
              </tr>
              <tr>
                <td style="width: 6em;">
                  <b>Ongkir</b>
                </td>
                <td>
                  <input type="number" style="width: 8em;" class="form-control" v-model="ongkir">
                </td>
              </tr>
              <tr>
                <td style="width: 6em;">
                  <b>Catatan</b>
                </td>
                <td>
                  <textarea class="form-control" v-model="note"></textarea>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label>Total Penjualan</label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered">
              <tr>
                <td>@{{ formatRupiah(hitungTotalPenjualan()) }}</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label>Total Bayar</label>
          </div>
          <div class="col-md-6">
            <label>Kembalian</label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <table class="table table-bordered">
              <tr>
                <td>
                  <input type="number" style="width: 8em;" class="form-control" v-model="totalPaid">
                </td>
              </tr>
            </table>
          </div>
          <div class="col-md-6">
            <table class="table table-bordered">
              <tr>
                <td>
                  <input type="text" style="width: 8em;" class="form-control" :value="[[ formatRupiah(hitungKembalian()) ]]" disabled>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form action="">
              <button type="button" v-on:click="buatTransaksi" class="btn btn-success">Buat Transaksi</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <form id="sales-form" action="{{ route('admin.sales.create.action') }}" method="POST">
      @csrf
      <input name="payment_method" type="hidden" :value="[[ selectedPaymentMethod ? selectedPaymentMethod.name : '' ]]">
      <input name="customer_id" type="hidden" :value="[[ selectedCustomer ? selectedCustomer.id : '' ]]">
      <input name="discount_id" type="hidden" :value="[[ selectedDiscount ? selectedDiscount.id : '' ]]">
      <input name="total_paid" type="hidden" :value="[[ totalPaid ]]">
      <input name="total_ongkir" type="hidden" :value="[[ ongkir ]]">
      <input name="note" type="hidden" :value="[[ note ]]">
      <input name="carts" type="hidden" :value="[[ JSON.stringify(carts) ]]">
    </form>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />
@endpush

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
  <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script>

    var app = new Vue({
      el: '#app',
      data: {
        carts: [],
        subTotal: 0,
        selectedCategory: 'ALL',
        selectedCustomer: null,
        selectedDiscount: null,
        selectedPaymentMethod: @json($payment_methods)[0] || {name: 'CASH'},
        selectedWarehouse: @json($warehouses)[0].id,
        ongkir: 0,
        totalPaid: 0,
        note: '',

        catalogs: @json($catalogs),
        warehouses: @json($warehouses),
        categories: @json($categories),
        discounts: @json($discounts),
        customers: @json($customers),
        payment_methods: @json($payment_methods),        
      },
      mounted: function () {
        $('#products').DataTable();
        $('#customers').DataTable();
        $('#discounts').DataTable();
        $('#payments').DataTable();
      },
      methods: {
        addToCart: function(catalog) {
          const stock = this.getStock(catalog.stocks);
          if(stock.total > 0) {
            let isExists = false;
            this.carts.map((cartItem) => {
              if(cartItem.id === catalog.id && cartItem.warehouse.id == this.selectedWarehouse) {
                cartItem.quantity += 1;
                isExists = true;
              }
              return cartItem;
            });
            if(!isExists) {
              console.log({...this.selectedWarehouse});
              this.carts.push({ ...catalog, quantity: 1, warehouse: {...this.getWarehouse()} });
            }
            stock.total -= 1;
          }
        },
        removeFromCart: function(catalog) {
          const stock = this.getStock(catalog.stocks);
          let isRemoved = false;
          this.carts.map((cartItem) => {
            if(cartItem.id === catalog.id && cartItem.warehouse.id == this.selectedWarehouse) {
              cartItem.quantity -= 1;
              isRemoved = cartItem.quantity <= 0;
            }
            return cartItem;
          });
          if(isRemoved) {
            this.carts = this.carts.filter((cartItem) => cartItem.quantity > 0);
          }
          stock.total += 1;
        },
        selectCustomer: function(customer) {
          this.selectedCustomer = customer;
        },
        selectDiscount: function(discount) {
          this.selectedDiscount = discount;
        },
        selectPaymentMethod: function(payment_method) {
          this.selectedPaymentMethod = payment_method;
        },

        hitungSubTotal: function() {
          return this.carts.reduce((result, cartItem) => result + (cartItem.selling_price * cartItem.quantity), 0);
        },
        hitungHargaDiskon: function() {
          let result = 0;
          let subTotal = this.hitungSubTotal();
          if(this.selectedDiscount) {
            if(this.selectedDiscount.type === 'PERCENTAGE') {
              result = (subTotal / 100) * parseInt(this.selectedDiscount.amount);
            } else {
              result = parseInt(this.selectedDiscount.amount);
            }
          }
          return result;
        },
        hitungTotalPenjualan: function() {
          let result = this.hitungSubTotal();
          result -= this.hitungHargaDiskon();
          if(this.ongkir) {
            result += parseInt(this.ongkir);
          }
          return result;
        },
        hitungKembalian: function() {
          if(!this.totalPaid) {
            return 0;
          }
          return parseInt(this.totalPaid) - this.hitungTotalPenjualan();
        },
        buatTransaksi: function () {
          if(this.carts.length === 0) {
            alert('Belum ada produk terpilih.')
            return
          }
          if(this.totalPaid <= 0 || this.totalPaid < this.hitungTotalPenjualan()) {
            alert('Uang pembayaran tidak cukup.')
            return
          }
          if(this.totalPaid <= 0 || this.totalPaid < this.hitungTotalPenjualan()) {
            alert('Uang pembayaran tidak cukup.')
            return
          }
          const formSales = document.getElementById('sales-form');
          formSales.submit();
        },
        
        getStock: function(stocks) {
          for(var i = 0; i < stocks.length; i++) {
            if(stocks[i].warehouse_id == this.selectedWarehouse) {
              return stocks[i];
            }
          }
          return {total: 0};
        },
        getWarehouse: function() {
          for(var i = 0; i < this.warehouses.length; i++) {
            if(this.warehouses[i].id == this.selectedWarehouse) {
              return this.warehouses[i];
            }
          }
          return null;
        },

        formatRupiah: function formatRupiah(angka){
          var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
          split   		= number_string.split(','),
          sisa     		= split[0].length % 3,
          rupiah     		= split[0].substr(0, sisa),
          ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

          if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
          }

          rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
          return (rupiah ? 'Rp. ' + rupiah : '');
        }
      }
    })
  </script>
@endpush