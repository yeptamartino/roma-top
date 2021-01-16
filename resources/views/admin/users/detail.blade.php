@extends('layouts.master')

@section('title')
<a href="{{ route('admin.users') }}" class="btn btn-primary">
    <i class="fa fa-arrow-left" title="Kembali"></i>
</a>


<form action="{{ route('admin.users.verify', ['id' => $user->id]) }}" method="POST"
    style="display: inline-block;">
  @method('put')
  @csrf
  <button type="submit" class="btn btn-success">
    Verifikasi
  </button>
</form>

<form action="{{ route('admin.users.unverify', ['id' => $user->id]) }}" method="POST"
    style="display: inline-block;">
  @method('put')
  @csrf
  <button type="submit" class="btn btn-danger">
   Tolak Verifikasi
  </button>
</form>


@endsection

@section('subtitle')
Detail Customer
@endsection

@section('content')
<table class="table table-border table-hover">
    <tbody>
        <tr>
            <th>Nama</th>
            <td>: {{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>: {{ $user->email }}</td>
        </tr>
        <tr>
            <th>Telepon</th>
            <td>: {{ $user->phone }}</td>
        </tr>
        <tr>
            <th>NIK</th>
            <td>: {{ $user->no_ktp }}</td>
        </tr>
        <tr>
            <th>Aalamat</th>
            <td>: {{ $user->address }}</td>
        </tr>
        <tr>
            <th>Status</th>

            @if($user->is_verified == 'VERIFIED')
                <td>: <button class="btn btn-xs btn-success">Terverifikasi</button></td>
            @elseif($user->is_verified == 'UNVERIFIED')
                <td>: <button class="btn btn-xs btn-warning">Belum Terverifikasi</button></td>
            @else
                <td>: <button class="btn btn-xs btn-danger">Verifikasi Ditolak</button></td>
            @endif
        </tr>
        <tr>
            <th>Foto KTP</th>
            <td>:  @if( $user->image_ktp == '')
                <a class="btn btn-primary btn-xs">Foto KTP belum ada.</a>
              @else
                <img src=" {{ $user->image_ktp }}" width="500"/>
              @endif</td>
        </tr>
    </tbody>
</table>
@endsection