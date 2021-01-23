@props([ 
  'action' => '',
  'name' => '',
  'address' => '',
  'phone' => '',
  'email' => '',
  'firstVisit' => '',
  'lastVisit' => '',
  'totalVisit' => '',
  'totalPaid' => '',
  'point' => '',
  'note' =>'' ,
  'thumbnail' =>'' ,
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
    <p style="color:blue">*Rekomendasi ukuran gambar 900 x 600 pixel</p>

  <x-input
    name="name"
    label="Nama"
    :value="$name"
  />
  <x-textarea
    name="address"
    label="Alamat"
    :value="$address"
  />

  <x-input
  name="phone"
  label="Telepon"
  :value="$phone"
  />
  <x-input
  name="email"
  label="Email"
  :value="$email"
  />
  <x-input
  name="first_visit"
  label="Kunjunagn Pertama"
  :value="$firstVisit"
  type="date"
  />
  <x-input
  name="last_visit"
  label="Kunjungan Terakhir"
  :value="$lastVisit"
  type="date"
  />
  <x-input
  name="total_visit"
  label="Total Kunjungan"
  :value="$totalVisit"
  type="number"
  />
  <x-input
  name="total_paid"
  label="Total Bayaran"
  :value="$totalPaid"
  type="number"
  />

  <x-input
  name="point"
  label="Poin"
  :value="$point"
  type="number"
  /> 
  
  <x-input
  name="note"
  label="Note"
  :value="$note"
  />


  @if($id)
    <x-button>
      Update Customer
    </x-button>
  @else
    <x-button>
      Tambah Customer
    </x-button>
  @endif
</form>