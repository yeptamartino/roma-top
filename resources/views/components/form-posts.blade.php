@props([ 
  'action' => '',
  'title' => '',
  'description' => '',
  'actionurl' => '',
  'actionurllabel' => '',
  'type' => '',
  'image' => '',
  'extraimage' => '',
  'id' => null,
  'postItems' => []
])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @if($id)
    @method('PUT')
  @endif
  @csrf

  <x-input
    type="file"
    name="image"
    label="Gambar" 
  />
  @if($image)
    <img src="{{ $image }}" width="200"/>
  @endif
  <p style="color:blue">*Rekomendasi ukuran gambar 900 x 600 pixel</p>

  <x-input
    type="file"
    name="extra_image"
    label="Ekstra Gambar" 
  />
  @if($extraimage)
  <img src="{{ $extraimage }}" width="200"/>
  @endif
  <p style="color:blue">*Rekomendasi ukuran gambar 900 x 600 pixel</p>
  <x-input
    name="title"
    label="Judul"
    :value="$title"
  />

  <x-textarea
  name="description"
  label="Deskripsi"
  :value="$description"
  />
  
  
  <x-input
  name="action_url"
  label="Aksi URL"
  :value="$actionurl"
  />
  
  <x-input
  name="action_url_label"
  label="Aksi URL Label"
  :value="$actionurllabel"
  />

  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <img src="{{ asset('adminlte/img/A.jpeg')}}" width="200">
        <p>Contoh Tampilan Type A</p>
      </div>
      <div class="col-md-4">
        <img src="{{ asset('adminlte/img/B.jpeg')}}" width="200">
        <p>Contoh Tampilan Type B</p>
      </div>
      <div class="col-md-4">
        <img src="{{ asset('adminlte/img/C.jpeg')}}" width="200">
        <p>Contoh Tampilan Type C</p>
      </div>
    </div>
  </div>

<div class="form-group">
  <label> Type</label>
  <select name="type" class="form-control form-control-sm">
    <option value="A" @if($type === 'A') selected @endif>A</option>
    <option value="B" @if($type === 'B') selected @endif>B</option>
    <option value="C" @if($type === 'C') selected @endif>C</option>
  </select>
</div>

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

@if($id)
<div class="container">
    <div class="row">
      <form action="{{ route('admin.post_item.store', ['post_id' => $id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
          <h4>Tambah Post Item</h4>
          <x-input
            name="post_item_title"
            label="Judul"
          />
    
          <x-textarea
            name="post_item_description"
            label="Deskripsi"
          />

          <x-input
          name="action_url"
          label="Aksi URL"
          />

          <x-input
          name="action_url_label"
          label="Aksi URL Label"
          />

          <x-input
            type="file"
            name="post_item_image"
            label="Gambar" 
          />
          <p style="color:blue">*Rekomendasi ukuran gambar 600 x 600 pixel</p>

          <x-button>
            Tambah Post Item
          </x-button>
        </div>
      </form>
    </div>
    <div class="row">
      <div class="col-md-10">
        <table class="table table-border table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Title</th>
              <th>Description</th>
              <th>Aksi URL</th>
              <th>Aksi URL Label</th>
              <th>Image</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if(count($postItems) > 0)
            @foreach($postItems as $post_item)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{ $post_item->title }}</td>
              <td>{{ $post_item->description }}</td>
              <td>{{ $post_item->action_url }}</td>
              <td>{{ $post_item->action_url_label }}</td>
              <td>
                <img src="{{ $post_item->image }}" width="100"/>
              </td>
              <td>
            <form action="{{ route('admin.post_item.delete', ['post_item_id' => $post_item->id]) }}" method="POST"
                style="display: inline-block;">
              @method('delete')
              @csrf
              <button type="submit" class="btn btn-danger" value="Delete" onclick="return confirm('Anda yakin ingin menghapus data ini ?')">
                <i class="fa fa-trash" title="Delete"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
        @else
          <tr>
            <td colspan="4">
              Belum ada data.
            </td>
          </tr>
        @endif
        </tbody>
        </table>
      </div>
    </div>
    
</div>
@endif