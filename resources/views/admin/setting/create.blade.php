@extends('layouts.master')

@section('subtitle')
TAMBAH PENGATURAN
@endsection

@section('content')

<x-form-setting
:action="route('admin.setting.store')"
/>
@endsection