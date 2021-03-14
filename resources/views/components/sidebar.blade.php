<!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree" style="margin-bottom: 100px">
    <li class="header">POINT OF SALE</li>
   
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    @if(Auth::user()->role === 'SUPER ADMIN')
      <li class="treeview">
        <a href="#">
          <i class="fa fa-bar-chart"></i>
          <span>Laporan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('admin.report.sales')}}"><i class="fa fa-circle-o"></i>Transaksi</a></li>        
        </ul>
      </li>
    @endif
    <li class="treeview">
      <a href="#">
        <i class="fa fa-money"></i>
        <span>Transaksi</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{route('admin.sales.create')}}"><i class="fa fa-circle-o"></i>Buat Transaksi</a></li>
        <li><a href="{{route('admin.sales')}}"><i class="fa fa-circle-o"></i>Daftar Transaksi</a></li>
      </ul>
    </li>

    @if(Auth::user()->role === 'SUPER ADMIN')
      <li class="treeview">
        <a href="#">
          <i class="fa fa-list"></i>
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
          <i class="fa fa-pie-chart"></i>
          <span>Katalog</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('admin.catalog')}}"><i class="fa fa-circle-o"></i>Daftar Katalog</a></li>
          <li><a href="{{route('admin.catalog.create')}}"><i class="fa fa-circle-o"></i>Tambah Katalog</a></li>
        </ul>
      </li>
      
        <li class="treeview">
          <a href="#">
            <i class="fa fa-building-o"></i>
            <span>Gudang</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.warehouse')}}"><i class="fa fa-circle-o"></i>Daftar Gudang</a></li>
            <li><a href="{{route('admin.warehouse.create')}}"><i class="fa fa-circle-o"></i>Tambah Gudang</a></li>
          </ul>
        </li>
      @endif

      <li class="treeview">
        <a href="#">
          <i class="fa fa-database"></i>
          <span>Stok</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('admin.stock')}}"><i class="fa fa-circle-o"></i>Daftar Stok</a></li>
          <li><a href="{{route('admin.stock.create')}}"><i class="fa fa-circle-o"></i>Tambah Stok</a></li>
        </ul>
      </li>
      @if(Auth::user()->role === 'SUPER ADMIN')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-percent"></i>
            <span>Diskon</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.discount')}}"><i class="fa fa-circle-o"></i>Daftar Diskon</a></li>
            <li><a href="{{route('admin.discount.create')}}"><i class="fa fa-circle-o"></i>Tambah Diskon</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Customer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.customer')}}"><i class="fa fa-circle-o"></i>Daftar Customer</a></li>
            <li><a href="{{route('admin.customer.create')}}"><i class="fa fa-circle-o"></i>Tambah Customer</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Metode Pembayaran</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.payment')}}"><i class="fa fa-circle-o"></i>Daftar Metode Pembayaran</a></li>
            <li><a href="{{route('admin.payment.create')}}"><i class="fa fa-circle-o"></i>Tambah Metode Pembayaran</a></li>
          </ul>
        </li>

        <li class="header">KONFIGURASI</li>      

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-plus"></i>
            <span>Admin</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.admin')}}"><i class="fa fa-circle-o"></i>Daftar Admin</a></li>
            <li><a href="{{route('admin.admin.create')}}"><i class="fa fa-circle-o"></i>Tambah Admin</a></li>
          </ul>
        </li>

        <li><a href="{{route('admin.setting.edit')}}"><i class="fa fa-wrench"></i>Pengaturan</a></li></a></li>
      @endif
      <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
           document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i><span>Logout</span></a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>       
      </li>    
  </ul>
