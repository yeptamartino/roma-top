@extends('layouts.master')

@section('subtitle')
EDIT GUDANG
@endsection

@section('content')
  <x-form-customer
    :action="route('admin.customer.update', ['id' => $customer->id])"
    :id="$customer->id"
    :name="$customer->name"
    :address="$customer->address"
    :phone="$customer->phone"
    :email="$customer->email"
    :totalPaid="$customer->total_paid"
    :note="$customer->note"
    :thumbnail="$customer->thumbnail"
  />
@endsection