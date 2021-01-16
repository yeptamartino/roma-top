@props([ 
  'action' => '',
  'id' => null,
])


<form action="{{ $action }}" method="GET" class="row">
  <div class="col-md-12">
    <div class="input-group input-group-sm col-md-5 pull-left">
      <input value="{{ request()->get('search') }}" type="text" name="search" class="form-control" placeholder="Pencarian..">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-info btn-flat">Cari</button>
          </span>
    </div>
  </div>
</form> 