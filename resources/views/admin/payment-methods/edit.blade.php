@extends('layouts.master')

@section('subtitle')
UBAH PEMBAYARAN
@endsection

@section('content')

<x-form-payments
:action="route('admin.payment.update', ['id' => $payment->id])"
:id="$payment->id"
:name="$payment->name"
:isActive="$payment->is_active"
/>
@endsection