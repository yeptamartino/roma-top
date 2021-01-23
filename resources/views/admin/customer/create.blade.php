@extends('layouts.master')

@section('subtitle')
TAMBAH CUSTOMER
@endsection

@section('content')

@if($errors->any())
      {{ implode('', $errors->all('<div>:message</div>')) }}
  @endif
  <x-form-customer
    :action="route('admin.customer.store')"
  />
@endsection