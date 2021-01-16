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
])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @if($id)
    @method('PUT')
  @endif
  @csrf

  <x-input-files
    name="thumbnail"
    label="Product Thumbnail"    
  />

  <x-input
    name="name"
    label="Nama Katalog"
    :value="$name"
  />

  <x-input
    type="number"
    name="capital_price"
    label="Harga Modal"
    :value="$capitalPrice"
  />
  <x-input
    type="number"
    name="selling_price"
    label="Harga Penjualan"
    :value="$sellingPrice"
  />
  <x-textarea
    name="description"
    label="Deskripsi"
    :value="$description"
  />

  <div class="form-group">
    <label for="category_id">Category*</label>
    <select name="category_id" class="form-control">
      @foreach($category as $category)
        @if($category->id === $selectedCategoryId)
          <option value="{{$category->id}}" selected>{{$category->name}}</option>
        @else
          <option value="{{$category->id}}">{{$category->name}}</option>
        @endif
      @endforeach
    </select>
  </div>

  @if($id)
    <x-button>
      Ubah Katalog
    </x-button>
  @else
    <x-button>
      Tambahkan Katalog
    </x-button>
  @endif
</form>