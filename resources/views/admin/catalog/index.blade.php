@extends('layouts.master')


@section('subtitle')
DAFTAR KATALOG
@endsection

@section('content')
@include('flash::message')
<div class="table-responsive">
  <table class="table" id="catalog">
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
        <td>@rupiah($catalog->capital_price)</td>
        <td>
          <ul>
            @foreach($catalog->prices as $price)
              <li>[{{ $price->name }}] - @rupiah($price->price) </li>
            @endforeach
          </ul>
        </td>
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
</div>
@endsection

@push('styles')
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />
@endpush

@push('scripts')
  <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#catalog').DataTable();
    });
  </script>
@endpush