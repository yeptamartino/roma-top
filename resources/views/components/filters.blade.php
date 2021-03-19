@props([
  'disableExports' => false,
  'disableSearch' => false,
  'disableDates' => false,
  'disablePencarian' => false,
  'searchPlaceholder' => '',
  'dateStartDefaultValue' => '',
  'dateEndDefaultValue' => '',
  'action' => '',
])

<form action="{{ $action }}" method="GET">
<div class="row">
  @if(!$disableDates)
  <div class="col-md-3">
      <div class="form-group">
          <label>Dari Tanggal</label>
          <input type="date" class="form-control" name="tgl_awal" value="{{ request()->get('tgl_awal') ?? $dateStartDefaultValue }}">
      </div>
  </div>

  <div class="col-md-3">
      <div class="form-group">
          <label>Sampai Tanggal</label>
          <input type="date" class="form-control" name="tgl_akhir" value="{{  request()->get('tgl_akhir') ?? $dateEndDefaultValue }}">
      </div>
  </div>
  @endif
  @if(!$disableSearch)
  <div class="col-md-3">
      <div class="form-group">
          <label>Pencarian</label>
      <input type="text" class="form-control" name="keyword" value="{{  request()->get('keyword') ?? '' }}" placeholder="{{ $searchPlaceholder }}">
      </div>
  </div>
  @endif
  @if(!$disableExports)
    <div class="col-md-3" style="margin-top: 25px;">
        <div class="form-group">
            <input type="submit" name="action" value="Cari" class="btn btn-info" title="Pencarian">
            <input type="submit" name="action" value="Excel" class="btn btn-success" title="Excel">
            <input type="submit" name="action" value="Pdf" class="btn btn-warning" title="Pdf">
            <a href="{{ URL::current() }}" class="btn btn-danger "> <i class="fa fa-refresh" title="Refresh"></i></a>
        </div>
    </div>
  @endif
  @if(!$disablePencarian)
    <div class="col-md-3" style="margin-top: 25px;">
        <div class="form-group">
            <input type="submit" name="action" value="Cari" class="btn btn-info" title="Pencarian">
        </div>
    </div>
  @endif
</div>
</form>