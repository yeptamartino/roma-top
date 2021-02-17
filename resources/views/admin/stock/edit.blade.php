@extends('layouts.master')

@section('subtitle')
EDIT STOK
@endsection

@section('content')
  <x-alert />
  <x-form-stock
    :action="route('admin.stock.update', ['id' => $stock->id])"
    :total="$stock->total"
    :id="$stock->id"
    :selected-catalog-id="$stock->catalog->id"
    :selected-warehouse-id="$stock->warehouse->id"
    :catalog="$catalog"
    :warehouse="$warehouse"
  />
@endsection