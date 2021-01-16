@extends('layouts.master')

@section('title')
User
@endsection

@section('subtitle')
Tambah User
@endsection

@section('content')
<x-form-users
:action="route('admin.users.store')"
/>
@endsection