@extends('layouts.master')


@section('subtitle')
SEMUA STOK
@endsection

@section('content')
<x-search-input :action="route('admin.stock')"/>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Katalog</th>
        <th>Gudang</th>
        <th>Total</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @if(count($stocks) > 0)
      @foreach($stocks as $stock)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $stock->catalog->name }}</td>
        <td>{{ $stock->warehouse->name }}</td>
        <td>{{ $stock->total }}</td>
       <td>
        <a
        href="{{ route('admin.stock.edit', ['id' => $stock->id]) }}"
        class="btn btn-warning"
        >
        <i class="fa fa-edit"></i>
      </a>
      <form action="{{ route('admin.stock.delete', ['id' => $stock->id]) }}" method="POST" style="display: inline-block;">
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
{{ $stocks->links() }}
</div>
@endsection