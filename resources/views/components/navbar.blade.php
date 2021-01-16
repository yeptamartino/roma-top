<header class="main-header">
<a href="" class="logo">
      <span class="logo-mini"><b></b></span>
      <span class="logo-lg"><b></b></span>
    </a>
    <nav class="navbar navbar-static-top fixed-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <p class="user-image"> 
              <i class="fa fa-user"></i>
              </p>
            <span class="hidden-xs">Andy</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-footer">
                <div class="pull-left">
                </div>
                <div class="pull-right">
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                   
                </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>