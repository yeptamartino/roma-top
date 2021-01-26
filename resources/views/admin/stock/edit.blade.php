@extends('layouts.master')

@section('subtitle')
EDIT STOK
@endsection

@section('content')
  @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
  @endif
  <x-alert />
  <x-form-stock
    :action="route('admin.stock.update', ['id' => $stock->id])"
    :total="$stock->total"
    :id="$stock->id"
    :catalog="$catalog"
    :selected-catalog-id="$stock->catalog->id"
    :warehouse="$warehouse"
    :selected-warehouse-id="$stock->warehouse->id"
  />
@endsection