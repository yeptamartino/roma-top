@props([ 
  'action' => '',
  'name' => '',
  'id' => null,
])

<form action="{{ $action }}" method="POST" >
  @if($id)
    @method('PUT')
  @endif
  @csrf

  <x-input
    name="name"
    label="Nama Frenchise"
    :value="$name"
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