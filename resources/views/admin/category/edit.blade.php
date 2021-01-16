@extends('layouts.master')

@section('admin-title')
Create Product Category
@endsection

@section('subtitle')
You can update product category here.
@endsection

@section('content')

<x-form-category
:action="route('admin.category.update', ['id' => $category->id])"
:id="$category->id"
:name="$category->name"
/>
@endsection