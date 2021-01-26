@extends('layouts.master')
@section('subtitle')
DAFTAR CUSTOMER
@endsection
@section('content')
@include('flash::message')
<x-search-input :action="route('admin.customer')"/>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Telepon</th>
        <th>Email</th>
        <th>Kunjungan Pertama</th>
        <th>Kunjuang Teralhir</th>
        <th>Total Kunjuang</th>
        <th>Total Bayaran</th>
        <th>Poin</th>
        <th>Foto</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @if(count($customers) > 0)
      @foreach($customers as $customer)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $customer->name }}</td>
        <td>{{ $customer->address }}</td>
        <td>{{ $customer->phone }}</td>
        <td>{{ $customer->email }}</td>
        <td>{{ $customer->first_visit }}</td>
        <td>{{ $customer->last_visit }}</td>
        <td>{{ $customer->total_visit }}</td>
        <td>{{ $customer->total_paid }}</td>
        <td>{{ $customer->point }}</td>
        <td>
        @if($customer->thumbnail)
        <img src="{{ asset('images/'.$customer->thumbnail) }}" 
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
        href="{{ route('admin.customer.edit', ['id' => $customer->id]) }}"
        class="btn btn-warning"
        >
        <i class="fa fa-edit"></i>
      </a>
      <form action="{{ route('admin.customer.delete', ['id' => $customer->id]) }}" method="POST" style="display: inline-block;">
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
{{ $customers->links() }}
</div>
@endsection