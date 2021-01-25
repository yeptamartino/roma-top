@props([ 
  'action' => '',
  'total' => '0',
  'id' => null,
  'catalog' => [],
  'selectedCatalogId' => '',
  'warehouse' => [],
  'selectedWarehouseId' => '',
])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @if($id)
    @method('PUT')
  @endif
  @csrf
  <x-input
    type="number"
    name="total"
    label="Total"
    :value="$total"
  />
  @if(!$id)
  <div class="form-group">
    <label for="catalog_id">Katalog*</label>
    <select name="catalog_id" class="form-control select2" style="width:100%">
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
    <select name="warehouse_id" class="form-control select2" style="width:100%">
      @foreach($warehouse as $warehouse)
        @if($warehouse->id === $selectedWarehouseId)
          <option value="{{$warehouse->id}}" selected>{{$warehouse->name}}</option>
        @else
          <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
        @endif
      @endforeach
    </select>
  </div>
  @endif
  @if($id)
    <x-button>
      Ubah Stok
    </x-button>
  @else
    <x-button>
      Tambah Stok
    </x-button>
  @endif
</form>