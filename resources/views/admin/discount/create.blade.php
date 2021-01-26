@extends('layouts.master')

@section('subtitle')
TAMBAH DISKON
@endsection

@section('content')
  <x-form-discount
    :action="route('admin.discount.store')"
  />
@endsection