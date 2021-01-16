@extends('layouts.master')

@section('subtitle')
EDIT GUDANG
@endsection

@section('content')
  <x-form-warehouses
    :action="route('admin.warehouse.update', ['id' => $warehouse->id])"
    :id="$warehouse->id"
    :name="$warehouse->name"
    :address="$warehouse->address"
    :thumbnail="$warehouse->thumbnail"
  />
@endsection