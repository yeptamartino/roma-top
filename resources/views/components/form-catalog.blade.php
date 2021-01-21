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

    @if($thumbnail)
    <img class="img img-responsive" src="{{ asset('images/'.$thumbnail) }}" style="max-width: 28em;" />
    @endif
    <p style="color:blue">*Rekomendasi ukuran gambar 900 x 600 pixel</p>

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
  <div class="form-group">
    <label for="category_id">Category*</label>
    <select name="category_id" class="form-control select2" style="width:100%">
      @foreach($category as $category)
        @if($category->id === $selectedCategoryId)
          <option value="{{$category->id}}" selected>{{$category->name}}</option>
        @else
          <option value="{{$category->id}}">{{$category->name}}</option>
        @endif
      @endforeach
    </select>
  </div>
  <x-textarea
    name="description"
    label="Deskripsi"
    :value="$description"
  />  

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