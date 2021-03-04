@extends('layouts.master')

@section('subtitle')
DAFTAR ADMIN
@endsection

@section('content')
@include('flash::message')
@if(Session::has('error'))
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger" role="alert">
        {{Session::get('error')}}
      </div>
    </div>
  </div>
@endif
<div class="table-responsive"> 
  <table class="table table-border table-hover" id="admins">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Foto</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @if(count($admins) > 0)
      @foreach($admins as $admin)
      <tr>
        <td>{{ $loop->iteration  + ((50 * (int)Request::get('page', 1) - 50)) }}</td>
        <td>{{ $admin->name }}</td>
        <td>{{ $admin->email }}</td>
        <td> 
          @if($admin->thumbnail)
          <img src="{{ asset('images/'.$admin->thumbnail) }}" 
          alt=""
          style="max-width: 8em;">
          @else
          <img src="{{ asset('images/default-image.png')}}" 
          alt="" 
          class="img img-responsive" 
          style="max-width: 8em;">
          @endif
        </td>
      
        <td>
          <a
        href="{{ route('admin.admin.edit', ['id' => $admin->id]) }}"
        class="btn btn-warning">
        <i class="fa fa-edit" title="Detail Edit"></i>
      </a>
      <form action="{{ route('admin.admin.delete', ['id' => $admin->id]) }}" method="POST"
          style="display: inline-block;">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger" value="Delete" onclick="return confirm('Anda yakin ingin menghapus data ini ?')">
          <i class="fa fa-trash" title="Delete"></i>
        </button>
      </form>
    </td>
  </tr>
  @endforeach
  @else
    <tr>
      <td colspan="4">
        Belum ada data.
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
      $('#admins').DataTable();
    });
  </script>
@endpush