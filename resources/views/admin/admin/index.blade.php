@extends('layouts.master')

@section('subtitle')
Daftar Admin ({{ $admins_count }})
@endsection

@section('content')
@include('flash::message')
<form method="get" action="{{route('admin.admin')}}">
  <div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label>Dari Tanggal</label>
            <input type="date" class="form-control" name="tgl_awal" value="{{ request()->get('tgl_awal') ?? date("y-m-d") }}">
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="form-group">
            <label>Sampai Tanggal</label>
            <input type="date" class="form-control" name="tgl_akhir" value="{{  request()->get('tgl_akhir') ?? date("y-m-d") }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Pencarian</label>
        <input type="text" class="form-control" name="keyword" value="{{  request()->get('keyword') ?? '' }}" placeholder="Berdasarkan: Nama, Email">
        </div>
    </div>
  
    <div class="col-md-2" style="margin-top: 25px;">
        <div class="form-group">
            <input type="submit" value="Cari" class="btn btn-info" title="Pencarian">
            <a href="{{route('admin.admin')}}" class="btn btn-danger "> <i class="fa fa-refresh" title="Refresh"></i></a>
        </div>
    </div>
  </div>
</form>
@if(Session::has('error'))
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger" role="alert">
        {{Session::get('error')}}
      </div>
    </div>
  </div>
@endif
<div class="table-responsive"> 
  <table class="table table-border table-hover">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Foto</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @if(count($admins) > 0)
      @foreach($admins as $admin)
      <tr>
        <td>{{ $loop->iteration  + ((50 * (int)Request::get('page', 1) - 50)) }}</td>
        <td>{{ $admin->name }}</td>
        <td>{{ $admin->email }}</td>
        <td> 
          @if( $admin->thumbnail == '')
          <a class="btn btn-primary btn-xs">Foto KTP belum ada.</a>
          @else
            <img src=" {{ $admin->thumbnail }}" width="100"/>
          @endif
        </td>
      
        <td>
          <a
        href="{{ route('admin.admin.edit', ['id' => $admin->id]) }}"
        class="btn btn-warning">
        <i class="fa fa-edit" title="Detail Edit"></i>
      </a>
      <form action="{{ route('admin.admin.delete', ['id' => $admin->id]) }}" method="POST"
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
{{ $admins->appends(request()->except('page'))->links('pagination.bootstrap3') }}
</div>
@endsection