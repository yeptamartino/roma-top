@props([ 
  'action' => '',
  'name' => '',
  'isActive' => '',
  'id' => null,
])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @if($id)
    @method('PUT')
  @endif
  @csrf

  <x-input
    name="name"
    label="Nama"
    :value="$name"
  />

  <x-input
    name="is_active"
    label="Status"
    :value="$isActive"
  />

  @if($id)
    <x-button>
    Ubah Pembayaran
    </x-button>
  @else
    <x-button>
    Tambah Pembayaran
    </x-button>
  @endif
</form>