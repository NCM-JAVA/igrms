
    
            <nav class="navbar navbar-expand-lg main-navbar bg-violet">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li>
                            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                        </li>
                        <li>
                            <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            @if(!empty(get_setting()))
                            <img alt="image" src=" {{ URL::asset('public/upload/admin/setting/')}}/{{ get_setting()->logo }}" class="rounded-circle mr-1" />
                         
                            @else
                            <img alt="image" src="{{ URL::asset('/public/assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1" />
                         
                            @endif
                              <div class="d-sm-none d-lg-inline-block">Hello, {{ ucfirst(Auth()->user()->name) }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            
                            <!--a href="features-profile.html" class="dropdown-item has-icon"> <i class="far fa-user"></i> Profile </a>
                            <a href="features-activities.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i> Activities </a>
                            <a href="features-settings.html" class="dropdown-item has-icon"> <i class="fas fa-cog"></i> Settings </a-->
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i> Logout </a>
                            <a href="{{ url('/Auth/resetpassword') }}"  class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i> Change Password </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
     

