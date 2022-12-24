<nav class="navbar navbar-default navbar-fixed-top navbar-color-on-scroll" color-on-scroll="100" id="sectionsNav">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"  href="{{ route('homepage.index') }}">
              <h3 style="position: absolute; margin-top:-5">  CVVork</h3>
            </a>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="material-icons">flag</i> Languages
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-with-icons">
                        <li>
                            <a href="{{ route('language', 'en') }}">
                                <img src="{{ asset('flag/us.svg') }}" alt="user-image" class="mr-1" height="12">
                                <span class="align-middle">English</span>
                            </a>
                            <a href="{{ route('language', 'vi') }}">
                                <img src="{{ asset('flag/vn.svg') }}" alt="user-image" class="mr-1" height="12">
                                <span class="align-middle">Tiếng Việt</span>
                            </a>
                        </li>
                    </ul>
                </li>


                @if(!auth()->check())
                    <li class="button-container">
                        <a href="{{ route('login') }}" class="btn btn-rose btn-round">
                            <i class="fa fa-user"></i> Đăng nhập
                        </a>
                    </li>
                @else

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i> {{ auth()->user() -> name   }}
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-with-icons">
                            <li>
                                <a href=" {{ route('logout') }}">
                                    <span class="align-middle"><i class="material-icons">logout</i> Logout</span>
                                </a>
                                {{--                                <a href="{{ route('language', 'vi') }}">--}}
                                {{--                                    <img src="{{ asset('flag/vn.svg') }}" alt="user-image" class="mr-1" height="12">--}}
                                {{--                                    <span class="align-middle">Tiếng Việt</span>--}}
                                {{--                                </a>--}}
                                @if(auth()->user()->role === 3 )
                                    <a href=" {{ route('hr.post_manager') }} ">
                                        <span class="align-middle">Post Manager</span>
                                    </a>
                                @elseif(auth()->user()->role === 1)
                                    <a href=" {{ route('admin.index') }} ">
                                        <span class="align-middle">Admin</span>
                                    </a>
                                @endif

                                <a href=" ">
                                    <span class="align-middle"><i class="material-icons">info</i> Profile</span>
                                </a>

                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
