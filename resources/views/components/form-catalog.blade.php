@props([ 
  'action' => '',
  'name' => '',
  'description' => '',
  'thumbnail' =>'' ,
  'sellingPrice' => '0',
  'capitalPrice' => '0',
  'id' => null,
  'category' => [],
  'selectedCategoryId' => '',
  'composites' => [],
  'catalogs' => [],
  'prices' => [],
])

<form id="app" action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @if($id)
    @method('PUT')
  @endif
  @csrf

  <x-input-files
    name="thumbnail"
    label="Product Thumbnail"    
  />

    @if($thumbnail)
    <img class="img img-responsive" src="{{ asset('images/'.$thumbnail) }}" style="max-width: 28em;" />
    @endif

  <x-input
    name="name"
    label="Nama Katalog"
    :value="$name"
  />

  <x-input
    type="text"
    name="capital_price"
    label="Harga Modal"
    :value="$capitalPrice"
    inputClass="currency-input"
  />
  <div class="form-group">
    <label>Tentukan Harga Jual</label>
  </div>
  <div class="row" v-for="price in prices">
    <div class="col-md-8">
      <div class="form-group">
        <label for="category_id">Nama Harga</label>
        <input name="price_names[]" type="text" class="form-control" v-model="price.name" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Harga</label>
        <input name="price_prices[]" type="number" class="form-control"  v-model="price.price" required>
      </div>
    </div>
    <div class="col-md-1">
      <button type="button" class="btn btn-danger" style="margin-top: 1.7em;" v-on:click="removePrice(price)">
        <i class="fa fa-trash" title="Delete"></i>
      </button>
    </div>
  </div>
  <div class="row" style="margin-bottom: 3em;">
    <div class="col-md-12">
      <button type="button" class="btn btn-success" v-on:click="addPrice">
        Tambah Harga
      </button>
    </div>
  </div>

  <div class="form-group">
    <label for="category_id">Kategori*</label>
    <select v-model="selectedCategoryId" v-on:change="onSelectedCategoryChanged" name="category_id" class="form-control" required>
      <option disabled value="">--- PILIH KATEGORI ---</option>
      @foreach($category as $c)
        <option value="{{ $c->id }}">{{$c->name}}</option>
      @endforeach
    </select>
  </div>
  <x-textarea
    name="description"
    label="Deskripsi"
    :value="$description"
  />  

  <div class="checkbox" v-show="isCompositeAllowed()">
    <label>
      <input name="compositeEnabled" v-model="compositeEnabled" type="checkbox"> Komposisi
    </label>
  </div>

  <div class="form-group" v-show="compositeEnabled">
    <label for="category_id">Tentukan Komposisi Produk</label>
  </div>
  <div v-show="compositeEnabled" class="row" v-for="composite in composites">
    <div class="col-md-8">
      <div class="form-group">
        <label for="category_id">Produk</label>
        <select :id="[[ `composite_select_${composite.id}` ]]" name="composite_ids[]" class="form-control select2" style="width:100%">
          <option v-for="catalog in catalogs" :value="[[ catalog.id ]]">@{{catalog.name}}</option>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Jumlah</label>
        <input name="composite_amounts[]" type="number" class="form-control" v-model="composite.amount">
      </div>
    </div>
    <div class="col-md-1">
      <button type="button" class="btn btn-danger" style="margin-top: 1.7em;" v-on:click="removeComposite(composite)">
        <i class="fa fa-trash" title="Delete"></i>
      </button>
    </div>
  </div>
  <div v-show="compositeEnabled" class="row" style="margin-bottom: 3em;">
    <div class="col-md-12">
      <button type="button" class="btn btn-success" v-on:click="addComposite">
        Tambah Komposisi
      </button>
    </div>
  </div>
  

  @if($id)
    <x-button>
      Ubah Katalog
    </x-button>
  @else
    <x-button>
      Tambah Katalog
    </x-button>
  @endif
</form>

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
  <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script>
    var composites = @json($composites);
    var catalogs = @json($catalogs);
    var categories = @json($category);
    var prices = @json($prices);
    var selectedCategoryId = '{{{ $selectedCategoryId }}}';

    var ID = function () {
      return '_' + Math.random().toString(36).substr(2, 9);
    };
    var emptyComposite = {
      composite_id: 0,
      amount: '',
      id: 0,
    };
    var emptyPrice = {
      name: '',
      price: '',
      id: 0,
    }
    var app = new Vue({
    el: '#app',
    data: {
      compositeEnabled: composites.length > 0,
      composites: composites.length > 0 ? [...composites] : [...composites, {...emptyComposite, id: ID()}],
      catalogs,
      categories,
      prices: prices.length > 0 ? [...prices] : [...prices, {...emptyPrice, id: ID()}],
      registeredListeners: [],
      selectedCategoryId: selectedCategoryId,
    },
    mounted: function() {
      this.selectAllComposites();
      const ini = this;
      $('#selectCategory').on('select2:select', function (e) {
        var data = e.params.data;
        if(data.text === 'KOMPOSISI') {
          ini.compositeEnabled = false;
        }
        console.log(data);
      });
      if(selectedCategoryId) {
        $('#selectCategory').val(selectedCategoryId);
      }
    },
    methods: {
      onSelectedCategoryChanged: function (e) {
        const ini = this;
        this.categories.forEach((category) => {
          if(e.target.value == category.id) {
            if(category.name === 'KOMPOSISI') {
              ini.compositeEnabled = false;
            }
          }
        })
      },
      addComposite: function () {
        const newComposite = {...emptyComposite, id: ID()};
        this.composites.push(newComposite);
        const ini = this;        
        ini.selectAllComposites();
      },
      selectAllComposites: function() {
        const ini = this;
        setTimeout(function () {
          $('.select2').select2();
          ini.composites.forEach((composite) => {
            $(`#composite_select_${composite.id}`).select2('val', `${composite.composite_id}`);            
            ini.registerSelectListeners(composite);
          });
        }, 100);
      },
      addPrice: function() {
        const newPrice = {...emptyPrice, id: ID()};
        this.prices.push(newPrice);
        this.initAllPrice();
      },
      removePrice: function (price) {
        if(this.prices.length > 1) {
          this.prices = this.prices.filter((c) => c.id != price.id);
        }
      },
      registerSelectListeners: function(composite) {
        const ini = this;
        if(!ini.registeredListeners.includes(composite.id)) {
          ini.registeredListeners.push(composite.id);
          $(`#composite_select_${composite.id}`).on('select2:select', function (e) {
            var data = e.params.data;
            ini.composites = ini.composites.map((c) => {
              if(composite.id == c.id) {
                return {
                  ...c,
                  composite_id: data.id
                };
              }
              return c;
            })
          });
        }
      },
      removeComposite: function (composite) {
        if(this.composites.length > 1) {
          this.composites = this.composites.filter((c) => c.id != composite.id);
        }
      },
      isCompositeAllowed: function() {
        let allowed = true;
        this.categories.forEach((category) => {
          if(this.selectedCategoryId == category.id) {
            if(category.name === 'KOMPOSISI') {
              allowed = false;
            }
          }
        })
        return allowed;
      } 
    }
    });
  </script>
@endpush

@push('styles')
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
  <script>
     $(document).ready(function() {
  $('#description').summernote();
});
    </script>
@endpush