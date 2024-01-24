<header class="wrapper bg-soft-primary">
    <nav class="navbar navbar-expand-lg center-nav transparent navbar-light">
        <div class="container flex-lg-row flex-nowrap align-items-center">
            <div class="navbar-brand w-100">
                <a href="{{ url('/') }}">
                    <img style="max-width: 90px; height: auto;" src="{{ url('/assets/images/logo.png') }}"
                        srcset="{{ url('/assets/images/logo.png') }}" alt="RHEA" />
                </a>
            </div>
            <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                <div class="offcanvas-header d-lg-none">
                    <h3 class="text-white fs-30 mb-0">RHEA</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                    <ul class="navbar-nav">
                        <li class="nav-item @if (Route::is('welcome')) active @endif">
                            <a class="nav-link" href="{{ route('welcome') }}">Home</a>
                        </li>
                        <li class="nav-item @if (Route::is('about')) active @endif">
                            <a class="nav-link" href="{{ route('about') }}">About Us</a>
                        </li>
                        <li class="nav-item @if (Route::is('events.list')) active @endif">
                            <a class="nav-link" href="{{ route('events.list') }}">Events</a>
                        </li>
                        <li class="nav-item @if (Route::is('blogs.list')) active @endif">
                            <a class="nav-link" href="{{ route('blogs.list') }}">Publications</a>
                        </li>
                        <li class="nav-item @if (Route::is('externalLinks.list')) active @endif">
                            <a class="nav-link" href="{{ route('externalLinks.list') }}">Resources</a>
                        </li>
                        @if (Auth::user() && Auth::user()->hasRole('member'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.members') }}">Members</a>
                            </li>
                        @endif
                        @guest
                            <li class="nav-item dropdown dropdown-mega  d-lg-none">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    aria-expanded="false">Account</a>
                                <ul class="dropdown-menu mega-menu mega-menu-dark mega-menu-img">
                                    <li class="mega-menu-content mega-menu-scroll">
                                        <ul class="row row-cols-1 list-unstyled">
                                            @if (Route::has('login'))
                                                <li class="col">
                                                    <a class="dropdown-item"
                                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                                </li>
                                            @endif
                                            @if (Route::has('register'))
                                                <li class="col">
                                                    <a class="dropdown-item"
                                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                                </li>
                                            @endif
                                        </ul>
                                        <!--/.row -->
                                    </li>
                                    <!--/.mega-menu-content-->
                                </ul>
                                <!--/.dropdown-menu -->
                            </li>
                        @else
                            <li class="nav-item dropdown dropdown-mega  d-lg-none">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    aria-expanded="false">{{ Auth::user()->name }}</a>
                                <ul class="dropdown-menu mega-menu mega-menu-dark mega-menu-img  custom">
                                    <li class="mega-menu-content mega-menu-scroll">
                                        <ul class="row row-cols-1 list-unstyled">
                                            <li class="col">
                                                <a class="dropdown-item" href="{{ route('profile') }}">Member Dashbaord</a>
                                            </li>
                                            <li class="col">
                                                <a class="dropdown-item"
                                                    href="{{ route('profile.change-password') }}">Change
                                                    Password</a>
                                            </li>
                                            <li class="col">
                                                <a class="dropdown-item" href="{{ route('profile.change-email') }}">Change
                                                    Mail</a>
                                            </li>
                                            @if (Auth::user() && Auth::user()->hasRole('member'))
                                                <li class="col">
                                                    <a class="dropdown-item" href="{{ route('profile.registrations') }}">
                                                        Registrations</a>
                                                </li>
                                                <li class="col">
                                                    <a class="dropdown-item"
                                                        href="{{ route('profile.transactions') }}">Transactions</a>
                                                </li>
                                                <li class="col">
                                                    <a class="dropdown-link"
                                                        href="{{ route('profile.members') }}">Members</a>
                                                </li>
                                            @endif
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            @can('access_dashboard')
                                                <li class="col">
                                                    <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                            @endcan
                                            <li class="col"><a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                            </li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </ul>
                                        <!--/.row -->
                                    </li>
                                    <!--/.mega-menu-content-->
                                </ul>
                                <!--/.dropdown-menu -->
                            </li>
                        @endguest
                    </ul>
                    <!-- /.navbar-nav -->
                    <div class="offcanvas-footer d-lg-none">
                        <div>
                            <a href="mailto:first.last@email.com" class="link-inverse">info@email.com</a>
                            <br /> 00 (123) 456 78 90 <br />
                            <nav class="nav social social-white mt-4">
                                <a href="#"><i class="uil uil-twitter"></i></a>
                                <a href="#"><i class="uil uil-facebook-f"></i></a>
                                <a href="#"><i class="uil uil-dribbble"></i></a>
                                <a href="#"><i class="uil uil-instagram"></i></a>
                                <a href="#"><i class="uil uil-youtube"></i></a>
                            </nav>
                            <!-- /.social -->
                        </div>
                    </div>
                    <!-- /.offcanvas-footer -->
                </div>
                <!-- /.offcanvas-body -->
            </div>
            <!-- /.navbar-collapse -->
            <div class="navbar-other w-100 d-flex ms-auto">
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    @guest
                        <li class="nav-item dropdown language-select d-none d-lg-block">
                            <a class="nav-link dropdown-item dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
                            <ul class="dropdown-menu custom">
                                @if (Route::has('login'))
                                    <li class="nav-item"><a class="dropdown-item"
                                            href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item"><a class="dropdown-item"
                                            href="{{ route('register') }}">{{ __('Register') }}</a></li>
                                @endif
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown language-select d-none d-lg-block">
                            <a class="nav-link dropdown-item dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu custom">
                                <li class="nav-item"><a class="dropdown-item" href="{{ route('profile') }}">Member
                                        Dashbaord</a></li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('profile.change-password') }}">Change
                                        Password</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('profile.change-email') }}">Change
                                        Mail</a>
                                </li>
                                @if (Auth::user() && Auth::user()->hasRole('member'))
                                    <li class="nav-item">
                                        <a class="dropdown-item" href="{{ route('profile.registrations') }}">
                                            Registrations</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item"
                                            href="{{ route('profile.transactions') }}">Transactions</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item" href="{{ route('profile.members') }}">Members</a>
                                    </li>
                                @endif

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                @can('access_dashboard')
                                    <li class="nav-item"><a class="dropdown-item"
                                            href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                @endcan
                                <li class="nav-item"><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                </li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    @endguest
                    <li class="nav-item d-lg-none">
                        <button class="hamburger offcanvas-nav-btn"><span></span></button>
                    </li>
                </ul>
                <!-- /.navbar-nav -->
            </div>
            <!-- /.navbar-other -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- /.navbar -->
</header>
