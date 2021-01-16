@extends('layouts.master')

@section('title')
Admin
@endsection

@section('subtitle')
Tambah Admin
@endsection

@section('content')
<x-form-users
:action="route('admin.admin.store')"
/>
@endsection