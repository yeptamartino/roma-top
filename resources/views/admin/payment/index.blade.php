@extends('layouts.master')
@section('subtitle')
DAFTAR PEMBAYARAN
@endsection

@section('content')
@include('flash::message')
<div class="table-responsive">
  <table class="table" id="payment">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @if(count($payments) > 0)
      @foreach($payments as $payment)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $payment->name }}</td>
        <td>
          @if($payment->is_active == 1)
            <a class="btn btn-xs btn-success">Aktif</a>
          @else
            <a class="btn btn-xs btn-danger"> Non Aktif</a>
          @endif
        </td>
       <td>
        <a
        href="{{ route('admin.payment.edit', ['id' => $payment->id]) }}"
        class="btn btn-warning"
        >
        <i class="fa fa-edit"></i>
      </a>
      <form action="{{ route('admin.payment.delete', ['id' => $payment->id]) }}" method="POST" style="display: inline-block;">
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
      $('#payment').DataTable();
    });
  </script>
@endpush