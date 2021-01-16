@extends('layouts.master')

@section('admin-title')
Create Product Category
@endsection

@section('subtitle')
You can create category here.
@endsection

@section('content')

<x-form-category
:action="route('admin.category.store')"
/>
@endsection