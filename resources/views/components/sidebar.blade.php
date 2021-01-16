<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="image">
      <img src="{{ asset('adminlte/img/roma_top.png')}}" width="600">
    </div>
  </div>
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">KONTEN APLIKASI</li>
   
    <li><a href=""><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

    {{-- <li class="treeview">
      <a href="#">
        <i class="fa fa-asterisk"></i>
        <span>Frenchise</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{route('admin.frenchises')}}"><i class="fa fa-circle-o"></i>Daftar Frenchise</a></li>
        <li><a href="{{route('admin.frenchises.create')}}"><i class="fa fa-circle-o"></i>Tambah Frenchise</a></li>
      </ul>
    </li> --}}

   
    <li class="treeview">
      <a href="#">
        <i class="fa fa-newspaper-o"></i>
        <span>Kategori</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{route('admin.category')}}"><i class="fa fa-circle-o"></i>Daftar Kategori</a></li>
        <li><a href="{{route('admin.category.create')}}"><i class="fa fa-circle-o"></i>Tambah Kategori</a></li>
      </ul>
    </li>
    
    <li class="treeview">
      <a href="#">
        <i class="fa fa-bell"></i>
        <span>Katalog</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href=""><i class="fa fa-circle-o"></i>Daftar Katalog</a></li>
        <li><a href=""><i class="fa fa-circle-o"></i>Tambah Katalog</a></li>
      </ul>
    </li>

    <li class="treeview">
      <a href="#">
        <i class="fa fa-image"></i>
        <span>Stok</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href=""><i class="fa fa-circle-o"></i>Daftar Stok</a></li>
        <li><a href=""><i class="fa fa-circle-o"></i>Tambah Stok</a></li>
      </ul>
    </li>
     
      <li class="treeview">
        <a href="#">
          <i class="fa fa-building-o"></i>
          <span>Kota</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href=""><i class="fa fa-circle-o"></i>Daftar Kota</a></li>
          <li><a href=""><i class="fa fa-circle-o"></i>Tambah Kota</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-archive"></i>
          <span>Outlet</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href=""><i class="fa fa-circle-o"></i>Daftar Outlet</a></li>
          <li><a href=""><i class="fa fa-circle-o"></i>Tambah Outlet</a></li>
        </ul>
      </li>

      <li class="header">CUSTOMER</li>
   
      <li><a href=""><i class="fa fa-star-o"></i><span>Pemenang</span></a></li>
      <li><a href=""><i class="fa fa-user"></i><span>Daftar Customer</span></a></li>
      <li><a href=""><i class="fa fa-qrcode"></i><span>Scan</span></a></li>
      <li><a href=""><i class="fa fa-percent"></i><span>Kupon</span></a></li>
      <li><a href=""><i class="fa fa-pie-chart"></i><span>Daftar Bisnis</span></a></li>
      <li class="header">KONFIGURASI</li>
      <li><a href=""><i class="fa fa-key"></i><span>Ubah Password</span></a></li>
        
      <li class="treeview">
        <a href="#">
          <i class="fa fa-user-plus"></i>
          <span>Admin</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href=""><i class="fa fa-circle-o"></i>Daftar Admin</a></li>
          <li><a href=""><i class="fa fa-circle-o"></i>Tambah Admin</a></li>
        </ul>
      </li>
      
      <li><a href=""><i class="fa fa-circle"></i><span>Logs</span></a></li>
      <li><a href=""><i class="fa fa-gear"></i><span>Pengaturan</span></a></li>
    
  </ul>
</section>