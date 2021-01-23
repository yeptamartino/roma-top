@props([ 
  'action' => '',
  'name' => '',
  'description' => '',
  'type' =>'' ,
  'amount' =>'' ,
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
  <x-textarea
    name="description"
    label="Deskripsi"
    :value="$description"
  />
  <div class="form-group">
    <label> Type</label>
    <select name="type" class="form-control form-control-sm">
      <option value="Persen" @if($type === 'Persen') selected @endif>Persen</option>
      <option value="Total" @if($type === 'Total') selected @endif>Total</option>
    </select>
  </div>

  <x-input
    name="amount"
    label="Jumlah"
    :value="$amount"
    type="number"
  />


  @if($id)
    <x-button>
      Update Diskon
    </x-button>
  @else
    <x-button>
      Tambah Diskon
    </x-button>
  @endif
</form>