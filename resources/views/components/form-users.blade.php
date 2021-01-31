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

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @if($id)
    @method('PUT')
  @endif
  @csrf

  <x-input-files
    name="thumbnail"
    label="Foto"    
  />

  @if($thumbnail)
    <img class="img img-responsive" src="{{ asset('images/'.$thumbnail) }}" style="max-width: 28em;" />
  @endif
    <p style="color:blue">*Rekomendasi ukuran gambar 160 x 160 pixel</p>

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
    label="Telepon"
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
      Ubah Admin
    </x-button>
  @else
    <x-button>
      Tambah Admin
    </x-button>
  @endif
</form>