@props([ 
  'action' => '',
  'name' => '',
  'price' => '0',
  'actual_price' => '0',
  'productDetails' => '',
  'howToUse' => '',
  'thumbnail' =>'' ,
  'tags' => '',
  'weight' => '0',
  'id' => null,
  'productCategory' => [],
  'selectedProductCategoryId' => '',
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
    label="Product Name"
    :value="$name"
  />
  <x-input
    type="number"
    name="price"
    label="Product Price"
    :value="$price"
  />
  <x-input
    type="number"
    name="actual_price"
    label="Product Actual Price"
    :value="$actual_price"
  />
  <x-input
    type="number"
    name="weight"
    label="Product Weight (gram)"
    :value="$weight"
  />
  <x-textarea
    name="description"
    label="Deskripsi"
    :value="$description"
  />


  <div class="form-group">
    <label for="ategory_id">Product Category*</label>
    <select name=category_id" class="form-control">
      @foreach($productCategory as $category)
        @if($category->id === $selectedProductCategoryId)
          <option value="{{$category->id}}" selected>{{$category->name}}</option>
        @else
          <option value="{{$category->id}}">{{$category->name}}</option>
        @endif
      @endforeach
    </select>
  </div>

  @if($id)
    <x-button>
      Update Product
    </x-button>
  @else
    <x-button>
      Create Product
    </x-button>
  @endif
</form>