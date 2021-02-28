@extends('layouts.master')


@section('subtitle')
DAFTAR STOK
@endsection

@section('content')
@include('flash::message')
<div class="table-responsive">
  <table class="table" id="stock">
    <thead>
      <tr>
        <th>No.</th>
        <th>Gudang</th>
        <th>Katalog</th>
        <th>Kategori</th>
        <th>Total</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @if(count($stocks) > 0)
      @foreach($stocks as $stock)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $stock->warehouse->name }}</td>
        <td>{{ $stock->catalog->name }}</td>
        <td>{{ $stock->catalog->category->name }}</td>        
        <td>{{ $stock->total }}</td>
        <td>
          @if($stock->catalog->composites)
            <a
              href="{{ route('admin.stock.mutate', ['id' => $stock->id]) }}"
              class="btn btn-primary"
              >
              <i class="fa fa-database"></i>
            </a>
          @endif
          <a
            href="{{ route('admin.stock.transfer', ['id' => $stock->id]) }}"
            class="btn btn-success"
            >
            <i class="fa fa-arrows-h"></i>
          </a>
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
</div>
@endsection
@push('styles')
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />
@endpush

@push('scripts')
  <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#stock').DataTable();
    });
  </script>
@endpush