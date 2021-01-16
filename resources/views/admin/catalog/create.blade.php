@extends('layouts.master')

@section('subtitle')
TAMBAH KATALOG
@endsection

@section('content')

@if($errors->any())
      {{ implode('', $errors->all('<div>:message</div>')) }}
  @endif
  <x-form-catalog
    :action="route('admin.catalog.store')"
    :category="$category"
  />
@endsection