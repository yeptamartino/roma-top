@props([ 
  'action' => '',
  'code' => '',
  'outletcode' => 0,
  'title' => '',
  'description' => '',
  'userid' => '',
  'expiredat' => '',
  'id' => null,
])

<form action="{{ $action }}" method="POST" >
  @if($id)
    @method('PUT')
  @endif
  @csrf

  <x-input
    name="code"
    label="Kode"
    :value="$code"
  />

  <x-input
  name="outlet_code"
  label="Kode Outlet"
  :value="$outletcode"
  type="number"
/>

<x-input
name="title"
label="Judul"
:value="$title"
/>

<x-input
name="description"
label="Deskripsi"
:value="$description"
/>

<x-input
name="user_id"
label="Pengguna"
:value="$userid"
/>

<x-input
name="expired_at"
label="Expired"
:value="$expiredat"
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