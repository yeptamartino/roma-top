@extends('layouts.master')

@section('subtitle')
TAMBAH STOK
@endsection

@section('content')

@if($errors->any())
      {{ implode('', $errors->all('<div>:message</div>')) }}
  @endif
  <x-form-stock
    :action="route('admin.stock.store')"
    :catalog="$catalog"
    :warehouse="$warehouse"
  />
@endsection