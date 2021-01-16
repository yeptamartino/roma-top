@extends('layouts.master')

@section('subtitle')
Daftar Admin ({{ $admins_count }})
@endsection

@section('content')
@include('flash::message')
<form method="get" action="{{route('admin.admins')}}">
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
        <input type="text" class="form-control" name="keyword" value="{{  request()->get('keyword') ?? '' }}" placeholder="Berdasarkan: Nama, Email, No. KTP">
        </div>
    </div>
    <div class="col-md-2" style="margin-top: 25px;">
        <div class="form-group">
          <select name="type" class="form-control form-control-sm">
            <option value="" @if(!request()->get('type')) selected @endif>Semua</option>
            <option value="VERIFIED" @if(request()->get('type') === 'VERIFIED') selected @endif>Terverifikasi</option>
            <option value="UNVERIFIED" @if(request()->get('type') === 'UNVERIFIED') selected @endif>Belum Terverifikasi</option>
            <option value="REJECTED" @if(request()->get('type') === 'REJECTED') selected @endif>Verifikasi Ditolak</option>
          </select>
        </div>
    </div>
    <div class="col-md-2" style="margin-top: 25px;">
        <div class="form-group">
            <input type="submit" value="Cari" class="btn btn-info" title="Pencarian">
            <a href="{{route('admin.admins')}}" class="btn btn-danger "> <i class="fa fa-refresh" title="Refresh"></i></a>
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
        <th>No KTP</th>
        <th>Foto KTP</th>
        <th>Status</th>
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
        <td>{{ $admin->no_ktp }}</td>
        <td> 
          @if( $admin->image_ktp == '')
          <a class="btn btn-primary btn-xs">Foto KTP belum ada.</a>
          @else
            <img src=" {{ $admin->image_ktp }}" width="100"/>
          @endif
        </td>
        <td>
          @if($admin->is_verified == 'VERIFIED')
            <button class="btn btn-xs btn-success">Terverifikasi</button>
          @elseif($admin->is_verified == 'REJECTED')
            <button class="btn btn-xs btn-danger"> Verifikasi Ditolak</button>
          @else
            <button class="btn btn-xs btn-warning">Belum Terverifikasi</button>
          @endif
        
        </td>
        <td>
          <a
        href="{{ route('admin.admins.edit', ['id' => $admin->id]) }}"
        class="btn btn-warning">
        <i class="fa fa-edit" title="Detail Edit"></i>
      </a>
      <a href="{{ route('admin.admins.detail', ['id' => $admin->id]) }}" class="btn btn-primary">
        <i class="fa fa-eye" title="Detail"></i>
      </a>
      <form action="{{ route('admin.admins.delete', ['id' => $admin->id]) }}" method="POST"
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