@extends('layouts.master')


@section('subtitle')
DAFTAR PENGATURAN
@endsection

@section('content')
@include('flash::message')
<x-search-input :action="route('admin.setting')"/>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @if(count($settings) > 0)
      @foreach($settings as $setting)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $setting->name }}</td>
        <td>{{ $setting->is_active }}</td>
       <td>
        <a
        href="{{ route('admin.setting.edit', ['id' => $setting->id]) }}"
        class="btn btn-warning"
        >
        <i class="fa fa-edit"></i>
      </a>
      <form action="{{ route('admin.setting.delete', ['id' => $setting->id]) }}" method="POST" style="display: inline-block;">
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
{{ $settings->links() }}
</div>
@endsection