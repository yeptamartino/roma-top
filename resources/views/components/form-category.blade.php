@props([ 
  'action' => '',
  'name' => '',
  'id' => null,
])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @if($id)
    @method('PUT')
  @endif
  @csrf

  <x-input
    name="name"
    label="Nama Kategori"
    :value="$name"
  />

  @if($id)
    <x-button>
    Ubah Kategori
    </x-button>
  @else
    <x-button>
    Tambahkan Kategori
    </x-button>
  @endif
</form>