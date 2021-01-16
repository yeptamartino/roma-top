@extends('layouts.master')

@section('subtitle')
TAMBAH KATEGORI
@endsection

@section('content')

<x-form-category
:action="route('admin.category.store')"
/>
@endsection