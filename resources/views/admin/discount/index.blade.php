@extends('layouts.master')
@section('subtitle')
DAFTAR DISKON
@endsection

@section('content')
@include('flash::message')
<x-search-input :action="route('admin.discount')"/>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Type</th>
        <th>Jumlah</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @if(count($discounts) > 0)
      @foreach($discounts as $discount)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $discount->name }}</td>
        <td>{{ $discount->description }}</td>
        <td>{{ $discount->type }}</td>
        <td>{{ $discount->amount }}</td>
       <td>
        <a
        href="{{ route('admin.discount.edit', ['id' => $discount->id]) }}"
        class="btn btn-warning"
        >
        <i class="fa fa-edit"></i>
      </a>
      <form action="{{ route('admin.discount.delete', ['id' => $discount->id]) }}" method="POST" style="display: inline-block;">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger" value="Delete" onclick="return confirm('Delete Data?')">
          <i class="fa fa-trash" title="Delete"></i>
        </button>
      </form>
    </td>
  </tr>
  @endforeach
  @else
    <tr>
      <td colspan="4">
       Belum Ada Data.
      </td>
    </tr>
  @endif
</tbody>
</table>
{{ $discounts->links() }}
</div>
@endsection