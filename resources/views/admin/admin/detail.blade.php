@extends('layouts.master')

@section('title')
<a href="{{ route('admin.admin') }}" class="btn btn-primary">
    <i class="fa fa-arrow-left" title="Kembali"></i>
</a>
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
            <th>Aalamat</th>
            <td>: {{ $admin->address }}</td>
        </tr>
       
        <tr>
            <th>Foto</th>
            <td>:  @if( $admin->thumbnail == '')
                <a class="btn btn-primary btn-xs">Foto belum ada.</a>
              @else
                <img src=" {{ $admin->thumbnail }}" width="500"/>
              @endif</td>
        </tr>
    </tbody>
</table>
@endsection