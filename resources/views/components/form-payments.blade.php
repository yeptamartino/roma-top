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
  <div class="form-group">
    <label> Type</label>
    <select name="is_active" class="form-control form-control-sm">
      <option value="1" @if($isActive === '1') selected @endif>A</option>
      <option value="B" @if($isActive === 'B') selected @endif>B</option>
      <option value="C" @if($isActive === 'C') selected @endif>C</option>
    </select>
  </div>
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