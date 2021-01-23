@extends('layouts.master')
@section('subtitle')
Penjualan
@endsection

@section('content')
  <div class="container" id="app">
    <div class="row">
      <div class="col-md-4">
        <x-input-group
          placeholder="Pelanggan"
          actionText="Pilih Pelanggan"
          actionHref="/"
          name="customer_id"
          disabled="disabled"
        />
      </div>
      <div class="col-md-4">
        <x-input-group
          placeholder="Voucher"
          actionText="Pilih Voucher"
          actionHref="/"
          name="voucher_id"
          disabled="disabled"
        />
      </div>
    </div>
    <div class="row" style="margin-top: 1em;">
      <div class="col-md-7">
        <label>Pilih Produk</label>
      </div>
      <div class="col-md-5">
        <label>Produk Terpilih</label>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7">
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
        <table id="products" class="table table-bordered">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Hrg. Modal</th>
              <th>Hrg. Jual</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="catalog in catalogs.filter((item) => selectedCategory === 'ALL' || selectedCategory == item.category_id)">
              <td>@{{ catalog.name }}</td>
              <td>@{{ formatRupiah(catalog.capital_price) }}</td>
              <td>@{{ formatRupiah(catalog.selling_price) }}</td>
              <td>
                <a href="#" v-on:click="addToCart(catalog)" class="btn btn-success">Tambahkan</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-5">  
        <div class="row">
          <div class="col-md-12 table-responsive">
            <table class="table table-bordered">
              <tr>
                <th>Nama</th>
                <th>Jml.</th>
                <th>Hrg. Jual</th>
                <th>Hrg. Total</th>
              </tr>
              <tr v-for="cartItem in carts">
                <td>@{{ cartItem.name }}</td>
                <td>
                  <a href="#" v-on:click="removeFromCart(cartItem)" class="btn btn-danger">-</a>
                  @{{ cartItem.quantity }}
                  <a href="#" v-on:click="addToCart(cartItem)" class="btn btn-success">+</a>
                </td>
                <td style="width: 9em;">
                  <input type="number" class="form-control" v-model="cartItem.selling_price">
                </td>
                <td>
                  @{{ formatRupiah(cartItem.quantity * cartItem.selling_price) }}
                </td>
              </tr>
              <tr v-if="!carts.length">
                <td colspan="4">Belum ada produk terpilih.</td>
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
                <td>Subtotal</td>
                <td>@{{
                  formatRupiah(
                    carts.reduce((result, cartItem) => result + (cartItem.selling_price * cartItem.quantity), 0)
                  )
                }}</td>
              </tr>
              <tr>
                <td>Diskon</td>
                <td>-Rp. 0,-</td>
              </tr>
              <tr>
                <td style="width: 6em;">Ongkir</td>
                <td>
                  <input type="number" style="width: 6em;" class="form-control" v-model="ongkir">
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
                <td>Rp. 50.000</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form action="">
              <x-button theme="success">Buat Transaksi</x-button>
            </form>
          </div>
        </div>
      </div>
    </div>
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
        message: 'Hello Vue!',
        catalogs: @json($catalogs),
        categories: @json($categories),
        vouchers: @json($vouchers),
        customers: @json($customers),

        carts: [],
        subTotal: 0,
        selectedCategory: 'ALL',
        selectedPelanggan: null,
        selectedVoucher: null,
        ongkir: 0,
      },
      mounted: function () {
        $('#products').DataTable();
      },
      methods: {
        addToCart: function(catalog) {
          let isExists = false;
          this.carts.map((cartItem) => {
            if(cartItem.id === catalog.id) {
              cartItem.quantity += 1;
              isExists = true;
            }
            return cartItem;
          });
          if(!isExists) {
            this.carts.push({ ...catalog, quantity: 1 });
          }
        },
        removeFromCart: function(catalog) {
          let isRemoved = false;
          this.carts.map((cartItem) => {
            if(cartItem.id === catalog.id) {
              cartItem.quantity -= 1;
              isRemoved = cartItem.quantity <= 0;
            }
            return cartItem;
          });
          if(isRemoved) {
            this.carts = this.carts.filter((cartItem) => cartItem.quantity > 0);
          }
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