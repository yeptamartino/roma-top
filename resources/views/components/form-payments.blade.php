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
    label="Nama"
    :value="$name"
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