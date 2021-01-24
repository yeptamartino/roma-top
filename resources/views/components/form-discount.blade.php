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
    <label>Type</label>
    <select name="type" class="form-control form-control-sm">
      <option value="PERCENTAGE" @if($type === 'PERCENTAGE') selected @endif>POTONGAN PERSEN</option>
      <option value="AMOUNT" @if($type === 'AMOUNT') selected @endif>POTONGAN HARGA</option>
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