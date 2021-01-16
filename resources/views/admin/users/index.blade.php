@extends('layouts.master')

@section('subtitle')
Daftar Customer ({{ $users_count }})
@endsection
@section('content')
@include('flash::message')
<form method="get" action="{{route('admin.users')}}">
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
            <a href="{{route('admin.users')}}" class="btn btn-danger "> <i class="fa fa-refresh" title="Refresh"></i></a>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">

      <input type="submit" name="action" value="Excel" class="btn btn-success" title="Excel">
      <input type="submit" name="action" value="Pdf" class="btn btn-warning" title="Pdf">
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
<form action="{{ route('admin.users.verifyMultiple') }}" enctype="multipart/form-data" method="POST">
  @csrf
  <div class="row" style="margin-top: 2em;">
    <div class="col-md-12">
        <input type="submit" name="submit_verifikasi" value="Verifikasi" class="btn btn-success" title="Verifikasi">
        <input type="submit" name="submit_verifikasi" value="Tolak Verifikasi" class="btn btn-danger" title="Tolak Verifikasi">
    </div>
  </div>
  <div class="table-responsive"> 
    <table class="table table-border table-hover">
      <thead>
        <tr>
          <th>Pilih</th>
          <th>No.</th>
          <th>Tgl. Daftar</th>
          <th>Nama</th>
          <th>Email</th>
          <th>No KTP</th>
          <th>Foto KTP</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @if(count($users) > 0)
        @foreach($users as $user)
        <tr>
          <td>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="selected_users[]" value="{{ $user->id }}">
            </div>
          </td>
          <td>{{ $loop->iteration  + ((50 * (int)Request::get('page', 1) - 50)) }}</td>
          <td>{{ $user->created_at }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->no_ktp }}</td>
          <td> 
            @if( $user->image_ktp == '')
            <a class="btn btn-primary btn-xs">Foto KTP belum ada.</a>
            @else
              <img src=" {{ $user->image_ktp }}" width="300"/>
            @endif
          </td>
          <td>
            @if($user->is_verified == 'VERIFIED')
              <button class="btn btn-xs btn-success">Terverifikasi</button>
            @elseif($user->is_verified == 'REJECTED')
              <button class="btn btn-xs btn-danger"> Verifikasi Ditolak</button>
            @else
              <button class="btn btn-xs btn-warning">Belum Terverifikasi</button>
            @endif
          </td>
          <td style="display: flex; flex-direction: row;">
              <a style="margin-right: 0.5em;" href="{{ route('admin.users.detail', ['id' => $user->id]) }}" class="btn btn-primary">
                <i class="fa fa-eye" title="Detail"></i>
              </a>
              @if(Auth::user()->role === 'SUPER ADMIN')
                <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" href="{{ route('admin.users.delete', ['id' => $user->id]) }}"
                  style="display: inline-block;" class="btn btn-danger">
                  <i class="fa fa-trash" title="Delete"></i>
                </a>
              @endif
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
  {{ $users->appends(request()->except('page'))->links('pagination.bootstrap3') }}
  </div>
</form>
@endsection