<div class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="" href="index.html"><span class="navbar-brand"><span class="fa fa-paper-plane"></span> STMS</span></a></div>


      
    <div class="navbar-collapse collapse" style="height: 1px;">
      <ul id="main-menu" class="nav navbar-nav navbar-right">

        @guest
            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @else

            <li class="dropdown hidden-xs">

    
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> {{ Auth::user()->name }}
                        <i class="fa fa-caret-down"></i>
                    </a>
        
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('profile') }}">My Account</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Admin Panel</li>
                    <li><a href="./">Users</a></li>
                    <li><a href="./">Security</a></li>
                    <li><a tabindex="-1" href="./">Payments</a></li>
                    <li class="divider"></li>
                    <li><a tabindex="-1" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                    </li>
                  </ul>
                </li>

        @endguest

        
      </ul>

    </div>
  </div>