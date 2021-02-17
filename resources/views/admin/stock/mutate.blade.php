@extends('layouts.master')

@section('subtitle')
MUTASI STOK
@endsection

@section('content')
  <x-alert />
  <x-form-stock
    :action="route('admin.stock.update', ['id' => $stock->id])"
    :total="$stock->total"
    :id="$stock->id"
    :selected-catalog-id="$stock->catalog->id" 
    :selected-warehouse-id="$stock->warehouse->id"
    :composites="$stock->catalog->composites"
    :stockWarehouse="$stock->warehouse"
    :catalog="$catalog"
    :warehouse="$warehouse"
  />
@endsection