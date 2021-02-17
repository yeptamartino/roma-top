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
        <table class="table">
          <thead>
            <tr>
              <th>Nama Komposisi</th>
              <th>Jumlah Stok</th>
            </tr>
          </thead>
          <tbody>      
            @foreach($composites as $composite)
              <tr>
                <td>
                  {{ $composite->catalog->name }}
                </td>
                <td>
                  @if($composite->stocks)
                    @foreach($composite->stocks as $compositeStock)
                      @if($selectedWarehouseId === $compositeStock->id)
                        {{ $compositeStock->total }}
                      @endif
                    @endforeach
                  @else
                    0
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
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