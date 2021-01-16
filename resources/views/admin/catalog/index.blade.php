@extends('layouts.master')


@section('subtitle')
DAFTAR KATALOG
@endsection

@section('content')
<x-search-input :action="route('admin.catalog')"/>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Deskripsi</th>
        <th>Harga Modal</th>
        <th>Harga Penjualan</th>
        <th>Foto</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @if(count($catalogs) > 0)
      @foreach($catalogs as $catalog)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $catalog->name }}</td>
        <td>{{ $catalog->category->name }}</td>
        <td>{!! $catalog->description !!}</td>
        <td>{{ $catalog->capital_price }}</td>
        <td>{{ $catalog->selling_price }}</td>
        <td>
        @if($catalog->thumbnail)
        <img src="{{ asset('images/'.$catalog->thumbnail) }}" 
        alt=""
        style="max-width: 8em;">
        @else
        <img src="{{ asset('assets/images/default-image.png')}}" 
        alt="" 
        class="img img-responsive" 
        style="max-width: 8em;">
        @endif
      </td>
       <td>
        <a
        href="{{ route('admin.catalog.edit', ['id' => $catalog->id]) }}"
        class="btn btn-warning"
        >
        <i class="fa fa-edit"></i>
      </a>
      <form action="{{ route('admin.catalog.delete', ['id' => $catalog->id]) }}" method="POST" style="display: inline-block;">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger" value="Delete" onclick="return confirm('Delete Data?')">
          <i class="fa fa-trash" title="Delete"></i>
        </button>
      </form>
    </td>
  </tr>
  @endforeach
  @else
    <tr>
      <td colspan="4">
       Belum Ada Data.
      </td>
    </tr>
  @endif
</tbody>
</table>
{{ $catalogs->links() }}
</div>
@endsection