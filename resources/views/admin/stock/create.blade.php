@extends('layouts.master')

@section('subtitle')
TAMBAH STOK
@endsection

@section('content')
  <x-alert />
  <x-form-stock
    :action="route('admin.stock.store')"
    :catalog="$catalog"
    :warehouse="$warehouse"
  />
@endsection