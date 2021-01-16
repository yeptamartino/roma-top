@extends('layouts.master')

@section('title')
<a href="{{ route('admin.admins') }}" class="btn btn-primary">
    <i class="fa fa-arrow-left" title="Kembali"></i>
</a>


<form action="{{ route('admin.admins.verify', ['id' => $admin->id]) }}" method="POST"
    style="display: inline-block;">
  @method('put')
  @csrf
  <button type="submit" class="btn btn-success">
    Verifikasi
  </button>
</form>

<form action="{{ route('admin.admins.unverify', ['id' => $admin->id]) }}" method="POST"
    style="display: inline-block;">
  @method('put')
  @csrf
  <button type="submit" class="btn btn-danger">
   Tolak Verifikasi
  </button>
</form>


@endsection

@section('subtitle')
Detail Admin
@endsection

@section('content')
<table class="table table-border table-hover">
    <tbody>
        <tr>
            <th>Nama</th>
            <td>: {{ $admin->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>: {{ $admin->email }}</td>
        </tr>
        <tr>
            <th>Telepon</th>
            <td>: {{ $admin->phone }}</td>
        </tr>
        <tr>
            <th>NIK</th>
            <td>: {{ $admin->no_ktp }}</td>
        </tr>
        <tr>
            <th>Aalamat</th>
            <td>: {{ $admin->address }}</td>
        </tr>
        <tr>
            <th>Status</th>

            @if($admin->is_verified == 'VERIFIED')
                <td>: <button class="btn btn-xs btn-success">Terverifikasi</button></td>
            @elseif($admin->is_verified == 'UNVERIFIED')
                <td>: <button class="btn btn-xs btn-warning">Belum Terverifikasi</button></td>
            @else
                <td>: <button class="btn btn-xs btn-danger">Verifikasi Ditolak</button></td>
            @endif
        </tr>
        <tr>
            <th>Foto KTP</th>
            <td>:  @if( $admin->image_ktp == '')
                <a class="btn btn-primary btn-xs">Foto KTP belum ada.</a>
              @else
                <img src=" {{ $admin->image_ktp }}" width="500"/>
              @endif</td>
        </tr>
    </tbody>
</table>
@endsection