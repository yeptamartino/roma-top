@props([ 
  'action' => '',
  'thumbnail' =>'' ,
  'id' => null,
])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @if($id)
    @method('PUT')
  @endif
  @csrf



  <a href="{{route('admin.payment.create')}}" class="btn btn-primary btn-sm">Metode Pembayaran</a>

  <x-input-files
    name="thumbnail"
    label="Logo"    
  />
  @if($thumbnail)
    <img class="img img-responsive" src="{{ asset('images/'.$thumbnail) }}" style="max-width: 28em;" />
  @endif
    <p style="color:blue">*Rekomendasi ukuran gambar 900 x 600 pixel</p>
 

  @if($id)
    <x-button>
    Ubah Pengaturan
    </x-button>
  @else
    <x-button>
    Tambah Pengaturan
    </x-button>
  @endif
</form>