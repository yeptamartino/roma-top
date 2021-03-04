@extends('layouts.master')


@section('subtitle')
DAFTAR GUDANG
@endsection

@section('content')
@include('flash::message')
<div class="table-responsive">
  <table class="table" id="warehouse">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Foto</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @if(count($warehouses) > 0)
      @foreach($warehouses as $warehouse)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $warehouse->name }}</td>
        <td>{{ $warehouse->address }}</td>
        <td>
        @if($warehouse->thumbnail)
        <img src="{{ asset('images/'.$warehouse->thumbnail) }}" 
        alt=""
        style="max-width: 8em;">
        @else
        <img src="{{ asset('assets/images/default-image.png')}}" 
        alt="" 
        class="img img-responsive" 
        style="max-width: 8em;">
        @endif
      </td>
       <td>
        <a
        href="{{ route('admin.warehouse.edit', ['id' => $warehouse->id]) }}"
        class="btn btn-warning"
        >
        <i class="fa fa-edit"></i>
      </a>
      <form action="{{ route('admin.warehouse.delete', ['id' => $warehouse->id]) }}" method="POST" style="display: inline-block;">
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
      $('#warehouse').DataTable();
    });
  </script>
@endpush

