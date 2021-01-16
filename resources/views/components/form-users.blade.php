@props([ 
  'action' => '',
  'name' => '',
  'email' => '',
  'phone' => '',
  'address' => '',
  'role' => '',
  'thumbnail' => '',
  'id' => null,
])

<form action="{{ $action }}" method="POST" >
  @if($id)
    @method('PUT')
  @endif
  @csrf

  <x-input
    type="file"
    name="thumbnail"
    label="Gambar" 
  />

  <x-input
    name="name"
    label="Nama"
    :value="$name"
  />

  <x-input
    name="email"
    label="Email"
    :value="$email"
  />

  <x-input
    name="phone"
    label="Phone"
    :value="$phone"
  />

  <x-input
    name="address"
    label="Alamat"
    :value="$address"
  />

  <x-input
    name="password"
    label="Password"    
    type="password"
  />

  @if($id)
    <x-button>
      Ubah
    </x-button>
  @else
    <x-button>
      Tambah
    </x-button>
  @endif
</form>