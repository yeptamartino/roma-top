@extends('layouts.master')

@section('subtitle')
EDIT DISKON
@endsection

@section('content')
  <x-form-discount
    :action="route('admin.discount.update', ['id' => $discount->id])"
    :id="$discount->id"
    :name="$discount->name"
    :description="$discount->description"
    :type="$discount->type"
    :amount="$discount->amount"
  />
@endsection