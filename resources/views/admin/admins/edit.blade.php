@extends('layouts.master')

@section('title')
Admin
@endsection

@section('subtitle')
Ubah Admin
@endsection

@section('content')

<x-form-users
:action="route('admin.admins.update', ['id' => $admin->id])"
:id="$admin->id"
:name="$admin->name"
:email="$admin->email"
:phone="$admin->phone"
:noktp="$admin->no_ktp"
:address="$admin->address"
:is_verified="$admin->is_verified"
:role="$admin->role"
:password="$admin->password"
:imagektp="$admin->image_ktp"
/>
@endsection