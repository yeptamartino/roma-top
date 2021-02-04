<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Roma Top</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="{{ asset('adminlte/img/roma_top.png')}}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css')}}">
    @stack('styles')
     <!-- bootstrap wysihtml5 - text editor -->
    {{-- <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}"> --}}
    </head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
  <x-navbar></x-navbar>
  <aside class="main-sidebar">
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="image">
          <img src="{{('adminlte/img/roma-top.png')}}">
        </div>
      </div>
    <x-sidebar></x-sidebar>

  </section>
  </aside>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        @yield('title')
      </h1>      
    </section>
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">@yield('subtitle')</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          @yield('content')
        </div>
      </div>
    </section>    
  </div>
 <x-footer></x-footer>
</div>

<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{ asset('adminlte/js/adminlte.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

@stack('scripts')


<!-- Bootstrap WYSIHTML5 -->
{{-- <script src="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script> --}}
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })

  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>

{{-- <script>
  $(function () {
    $('.textarea').wysihtml5()
  })
</script> --}}
</body>
</html>
