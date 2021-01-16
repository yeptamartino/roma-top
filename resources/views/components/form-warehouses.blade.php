@props([ 
  'action' => '',
  'name' => '',
  'address' => '',
  'thumbnail' =>'' ,
  'id' => null,
])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @if($id)
    @method('PUT')
  @endif
  @csrf

  <x-input-files
    name="thumbnail"
    label="Foto"    
  />
  <x-input
    name="name"
    label="Nama"
    :value="$name"
  />
  <x-textarea
    name="address"
    label="Alamat"
    :value="$address"
  />


  @if($id)
    <x-button>
      Update Gudang
    </x-button>
  @else
    <x-button>
      Create Gudang
    </x-button>
  @endif
</form>