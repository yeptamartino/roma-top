@if(Session::has('error'))
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger" role="alert">
        {!! Session::get('error') !!}
      </div>
    </div>
  </div>
@endif
@if(Session::has('success'))
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-info" role="alert">
        {!! Session::get('success') !!}
      </div>
    </div>
  </div>
@endif