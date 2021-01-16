@extends('layouts.master')

@section('subtitle')
UBAH KATEGORI
@endsection

@section('content')

<x-form-category
:action="route('admin.category.update', ['id' => $category->id])"
:id="$category->id"
:name="$category->name"
/>
@endsection