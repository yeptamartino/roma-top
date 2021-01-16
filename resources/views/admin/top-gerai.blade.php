@extends('layouts.master')
@section('subtitle')
Top Gerai
@endsection
@section('content')
<form action="{{ route('admin.top') }}" method="GET">
  <div class="col-md-2" style="margin-top: 25px;">
    <div class="form-group">
      <select name="order_by" class="form-control form-control-sm">
        <option value="DESC" @if(request()->get('order_by') === 'DESC') selected @endif>Tertinggi</option>
        <option value="ASC" @if(request()->get('order_by') === 'ASC') selected @endif>Terendah</option>        
      </select>
    </div>
  </div>
  <div class="col-md-2" style="margin-top: 25px;">
    <div class="form-group">
        <input type="submit" value="Terapkan" class="btn btn-info" title="Pencarian">        
    </div>
  </div>
  </div>
</form>
    <div class="box-body">
      <table class="table table-bordered">
        <tr>
          <th style="width: 10px">#</th>
          <th>Kode Gerai</th>
          <th>Nama Gerai</th>
          <th>Total Scan</th>
        </tr>
        @foreach($top_outlets as $outlet)
        <tr>
          <td>{{ $loop->iteration  + ((50 * (int)Request::get('page', 1) - 50)) }}</td>
          <td>{{ $outlet->code }}</td>
          <td>{{ $outlet->name }}</td>
          <td>{{ $outlet->scans_count }}</td>
        </tr>
        @endforeach
      </table>
      {{ $top_outlets->appends(request()->except('page'))->links('pagination.bootstrap3') }}
    </div>
@endsection