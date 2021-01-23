@extends('layouts.master')

@section('subtitle')
TAMBAH DISKON
@endsection

@section('content')

@if($errors->any())
      {{ implode('', $errors->all('<div>:message</div>')) }}
  @endif
  <x-form-discount
    :action="route('admin.discount.store')"
  />
@endsection