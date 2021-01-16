@extends('layouts.master')

@section('subtitle')
TAMBAH GUDANG
@endsection

@section('content')

@if($errors->any())
      {{ implode('', $errors->all('<div>:message</div>')) }}
  @endif
  <x-form-warehouses
    :action="route('admin.warehouse.store')"
  />
@endsection