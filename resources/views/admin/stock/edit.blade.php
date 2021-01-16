@extends('layouts.master')

@section('subtitle')
EDIT STOK
@endsection

@section('content')
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