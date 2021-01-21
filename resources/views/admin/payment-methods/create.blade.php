@extends('layouts.master')

@section('subtitle')
TAMBAH PEMBAYARAN
@endsection

@section('content')

<x-form-payments
:action="route('admin.payment.store')"
/>
@endsection