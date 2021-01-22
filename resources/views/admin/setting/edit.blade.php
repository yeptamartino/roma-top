@extends('layouts.master')

@section('subtitle')
Edit Pengaturan
@endsection

@section('content')
@include('flash::message')
<x-form-settings
:action="route('admin.setting.update')"
:id="$setting->id"
:name="$setting->name"
:isActive="$setting->is_active"
/>
@endsection