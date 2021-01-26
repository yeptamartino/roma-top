@extends('layouts.master')

@section('subtitle')
TAMBAH CUSTOMER
@endsection

@section('content')
  <x-form-customer
    :action="route('admin.customer.store')"
  />
@endsection