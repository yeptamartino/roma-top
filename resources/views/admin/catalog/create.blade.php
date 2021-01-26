@extends('layouts.master')

@section('subtitle')
TAMBAH KATALOG
@endsection

@section('content')
  <x-form-catalog
    :action="route('admin.catalog.store')"
    :category="$category"
  />
@endsection