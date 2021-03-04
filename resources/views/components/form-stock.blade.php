@props([ 
  'action' => '',
  'total' => '0',
  'id' => null,
  'catalog' => [],
  'selectedCatalogId' => '',
  'warehouse' => [],
  'selectedWarehouseId' => '',
  'composites' => null,
  'stockWarehouse' => null
])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @if($id)
    @method('PUT')
  @endif
  @csrf
  <div class="form-group">
    <label for="catalog_id">Katalog*</label>
    <select name="catalog_id" class="form-control select2" style="width:100%" @if($id) disabled @endif>
      @foreach($catalog as $catalog)
        @if($catalog->id === $selectedCatalogId)
          <option value="{{$catalog->id}}" selected>{{$catalog->name}}</option>
        @else
          <option value="{{$catalog->id}}">{{$catalog->name}}</option>
        @endif
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="warehouse_id">Gudang*</label>
    <select name="warehouse_id" class="form-control select2" style="width:100%" @if($id) disabled @endif>
      @foreach($warehouse as $warehouse)
        @if($warehouse->id === $selectedWarehouseId)
          <option value="{{$warehouse->id}}" selected>{{$warehouse->name}}</option>
        @else
          <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
        @endif
      @endforeach
    </select>
  </div>

  @if($composites)
    <div class="row">
      <div class="col-md-12 table-responsive">
        <fieldset id="selected_stock_composite_ids">
          <table class="table">
            <thead>
              <tr>
                <th>Pilih</th>
                <th>Nama Komposisi</th>
                <th>Gudang</th>
                <th>Jumlah Stok</th>
              </tr>
            </thead>
            <tbody>      
              @foreach($composites as $composite)
                @foreach($composite->item->stocks as $stock)
                  <tr>
                    <td>
                      <input type="radio" value="{{ $stock->warehouse->id }}" name="selected_stock_composite_ids[{{ $composite->item->id }}]" @if($loop->iteration === 1) checked @endif>
                    </td>
                    <td>
                      {{ $composite->item->name }}
                    </td>
                    <td>
                      {{ $stock->warehouse->name }}
                    </td>
                    <td>
                      {{ $stock->total }}
                    </td>
                  </tr>
                @endforeach
              @endforeach
            </tbody>
          </table>
        </fieldset>
      </div>
    </div>
    <x-input
      type="number"
      name="current_total"
      label="Stock Saat Ini"
      :value="$total"
      :disabled="true"
    />
    <x-input
      type="number"
      name="total"
      label="Berapa Jumlah Barang Yang Ingin Anda Buat Dari Komposisi? (Minus untuk mengurangi)"
      :value="0"
    />
  @else
    <x-input
      type="number"
      name="total"
      label="Total"
      :value="$total"
    />
  @endif

  @if($composites)
    <x-button>
      Buat Stok
    </x-button>
  @elseif($id)
    <x-button>
      Ubah Stok
    </x-button>
  @else
    <x-button>
      Tambah Stok
    </x-button>
  @endif
</form>