@extends('layouts.master')

@section('subtitle')
EDIT KATALOG
@endsection

@section('content')
  <x-form-catalog
    :action="route('admin.catalog.update', ['id' => $catalog->id])"
    :name="$catalog->name"
    :description="$catalog->description"
    :sellingPrice="$catalog->selling_price"
    :capitalPrice="$catalog->capital_price"
    :thumbnail="$catalog->thumbnail"
    :id="$catalog->id"
    :category="$category"
    :selected-category-id="$catalog->category->id"
  />
@endsection