@extends('layouts.master')

@section('subtitle')
TRANSFER STOK
@endsection

@section('content')
  <x-alert />
  <x-form-stock-transfer
    :action="route('admin.stock.transfer.action', ['id' => $stock->id])"
    :total="$stock->total"
    :id="$stock->id"
    :selected-catalog-id="$stock->catalog->id" 
    :selected-warehouse-id="$stock->warehouse->id"
    :stockWarehouse="$stock->warehouse"
    :catalog="$catalog"
    :warehouse="$warehouse"
  />
@endsection