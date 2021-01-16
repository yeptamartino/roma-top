@props([ 
  'action' => '',
  'name' => '',
  'email' => '',
  'phone' => '',
  'noktp' => '',
  'address' => '',
  'is_verified' => '',
  'role' => '',
  'imagektp' => '',
  'id' => null,
])

<form action="{{ $action }}" method="POST" >
  @if($id)
    @method('PUT')
  @endif
  @csrf

  <x-input
    type="file"
    name="imagektp"
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
    name="no_ktp"
    label="No KTP"
    :value="$noktp"
    type="number"
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