@extends('layouts.master')


@section('subtitle')
DAFTAR KATALOG
@endsection

@section('content')
@include('flash::message')
<form method="get" action="{{route('admin.catalog')}}">
  <div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Pencarian</label>
        <input type="text" class="form-control" name="search" value="{{  request()->get('search') ?? '' }}">
        </div>
    </div>
    <div class="col-md-2">
      <div class="form-group" >
        <label for="category">Kategori</label>
        <select name="category" class="form-control">
          <option value="" @if(!request()->get('category')) selected @endif>Semua</option>
          @foreach($category as $category)
          <option value="{{$category->id}}" @if(request()->get('category_id') == 'category_i') selected @endif>{{$category->name}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-2" style="margin-top: 25px;">
        <div class="form-group">
            <input type="submit" value="Cari" class="btn btn-info" title="Pencarian">
            <a href="{{route('admin.catalog')}}" class="btn btn-danger "> <i class="fa fa-refresh" title="Refresh"></i></a>
        </div>
    </div>
  </div>
</form>

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
<div class="row">
  <div class="col-md-12">
    {{ $catalogs->appends(request()->except('page'))->links('pagination.bootstrap3') }}
  </div>
</div>
@endsection