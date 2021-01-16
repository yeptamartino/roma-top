@props([ 
  'action' => '',
  'title' => '',
  'description' => '',
  'image' => '',
  'actionurl' => '',
  'id' => null,
])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @if($id)
    @method('PUT')
  @endif
  @csrf
  <x-input
    type="file"
    name="image"
    label="Gambar" 
  />
  @if($image)
  <img src="{{ $image }}" width="200"/>
  @endif
<p style="color:blue">*Rekomendasi ukuran gambar 900 x 600 pixel</p>
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
name="action_url"
label="Aksi URL"
:value="$actionurl"
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