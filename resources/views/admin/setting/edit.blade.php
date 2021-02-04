@extends('layouts.master')

@section('subtitle')
Edit Pengaturan
@endsection

@section('subtitle')
Edit Pengaturan
@endsection

@section('content')
@include('flash::message')
<x-form-settings
:action="route('admin.setting.update')"
:id="$setting->id"
:thumbnail="$setting->thumbnail"
:pointRatio="$setting->point_ratio"
/>
@endsection