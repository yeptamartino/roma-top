@props([ 
  'action' => '',
  'thumbnail' =>'' ,
  'pointRatio' =>'' ,
  'id' => null,
])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @if($id)
    @method('PUT')
  @endif
  @csrf

  <x-input-files
    name="thumbnail"
    label="Logo"    
  />

  @if($thumbnail)
    <img class="img img-responsive" src="{{ asset('images/'.$thumbnail) }}" style="max-width: 28em;" />
  @endif
    <p style="color:blue">*Rekomendasi ukuran gambar 900 x 600 pixel</p>

    <x-input
    name="point_ratio"
    label="Rasio Poin"
    :value="$pointRatio"
    type="number"
  />
 

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