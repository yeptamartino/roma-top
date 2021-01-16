@extends('layouts.master')

@section('subtitle')
Ubah Admin
@endsection

@section('content')

<x-form-users
:action="route('admin.admin.update', ['id' => $admin->id])"
:id="$admin->id"
:name="$admin->name"
:email="$admin->email"
:phone="$admin->phone"
:address="$admin->address"
:role="$admin->role"
:password="$admin->password"
:thumbnail="$admin->thumbnail"
/>
@endsection