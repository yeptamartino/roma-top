@extends('layouts.master')

@section('title')
Customer
@endsection

@section('subtitle')
Ubah Customer
@endsection

@section('content')

<x-form-users
:action="route('admin.users.update', ['id' => $user->id])"
:id="$user->id"
:name="$user->name"
:email="$user->email"
:noktp="$user->no_ktp"
:address="$user->address"
:is_verified="$user->is_verified"
:role="$user->role"
:password="$user->password"
:imagektp="$user->image_ktp"
/>
@endsection