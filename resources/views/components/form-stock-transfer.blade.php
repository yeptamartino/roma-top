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
      @foreach($warehouse as $w)
        @if($w->id === $selectedWarehouseId)
          <option value="{{$w->id}}" selected>{{$w->name}}</option>
        @else
          <option value="{{$w->id}}">{{$w->name}}</option>
        @endif
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="warehouse_destination_id">Transfer Ke Gudang*</label>
    <select name="warehouse_destination_id" class="form-control select2" style="width:100%">
      @foreach($warehouse as $w)
        @if($w->id != $selectedWarehouseId)
          <option value="{{$w->id}}">{{$w->name}}</option>
        @endif
      @endforeach
    </select>
  </div>

  <x-input
    type="number"
    name="old_total"
    label="Stok di Gudang Lama"
    :value="$total"
    :disabled="true"
  />

  <x-input
    type="number"
    name="total"
    label="Total Transfer"
    :value="0"
  />
  <x-button>
    Transfer Stok
  </x-button>
</form>