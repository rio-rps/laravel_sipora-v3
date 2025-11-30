<nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto">
                    <a class="nav-link nav-menu-main menu-toggle hidden-xs " href="#">
                        <i class="feather icon-menu font-large-1"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="">
                        <img class="brand-logo" alt="Sumselprov" src="{{ asset('images/logo/logo_prov.png') }}">
                        <h3 class="brand-text" style="font-size:17px;margin-top:-17px;">{{ config('app.name') }}</h3>
                    </a>
                </li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                        data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                            href="#"><i class="feather icon-menu"></i></a></li>


                </ul>
                <ul class="nav navbar-nav float-right">

                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="avatar avatar-online">
                                <img src="{{ asset('images/user/user.png') }}" alt="avatar">
                                <i></i>
                            </div>
                            <span id="idemail">{{ Auth::user()->email }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('pengaturanakun.index') }}">
                                <i class="feather icon-unlock"></i>
                                Pengaturan Akun</a>
                            <div class="dropdown-divider">
                            </div><a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="feather icon-power"></i>
                                Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
