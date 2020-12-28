<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <link rel="icon" href="{{ url('images/icon/title-icon2.png') }}" type="image/x-icon"> 
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ url('css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('css/all.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ url('vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ url('vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/vector-map/jqvmap.min.css" rel="stylesheet')}}" media="all">

    <!-- Main CSS-->
    <link href="{{ url('css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            <div class="logo">
                <a href="">
                    <img style="width: 55px; height: 55px; " src="{{ url('images/icon/title-icon2.png')}}" alt="Cool Admin" />
                    <h2 style="color:white; display: inline;">Trash Bag</h2>
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <div class="account2">
                        <a href="{{ url('user/profile') }}" style="text-decoration: none; cursor: pointer; text-align:center;">
                            <div class="image img-cir img-120">
                                <img src="{{ Auth::user()->foto_profil }}" alt="John Doe" />
                            </div>
                            <h4 class="name">{{ Auth::user()->nama_lengkap }}</h4>
                        </a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    </form>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li class="{{ ($menu == 'home')?'active has-sub':'' }}">
                            <a class="js-arrow" href="{{ url('/') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                        <li class="{{ ($menu == 'pengurus')?'active has-sub':'' }}">
                            <a class="js-arrow" href="{{ url('/pengurus') }}">
                                <i class="fas fa-user-tie"></i>Pengurus
                            </a>
                        </li>
                        <li class="{{ ($menu == 'nasabah')?'active has-sub':'' }}">
                            <a class="js-arrow" href="{{ url('/') }}">
                                <i class="fas fa-users"></i>Nasabah
                            </a>
                        </li>
                        <li class="{{ ($menu == 'setoran')?'active has-sub':'' }}">
                            <a class="js-arrow" href="{{ url('/') }}">
                                <i class="fas fa-leaf"></i>Setoran
                            </a>
                        </li>
                        <li class="{{ ($menu == 'penjualan')?'active has-sub':'' }}">
                            <a class="js-arrow" href="{{ url('/') }}">
                                <i class="fas fa-hand-holding-usd"></i>Penjualan
                            </a>
                        </li>
                        <li class="{{ ($menu == 'keuangan')?'active has-sub':'' }}">
                            <a class="js-arrow" href="{{ url('/') }}">
                                <i class="fas fa-dollar-sign"></i>Keuangan Bank
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <a href="{{ url('/') }}">
                                    <img style="width: 55px; height:55px;" src="{{ url('images/icon/title-icon2.png')}}" alt="CoolAdmin" />
                                </a>
                            </div>
                            <div class="header-button2">
                                <div class="header-button-item mr-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                            </form>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                <div class="logo">
                    <a href="">
                        <img src="{{ url('images/icon/logo-white.png')}}" alt="Cool Admin" />
                    </a>
                </div>
                <div class="menu-sidebar2__content js-scrollbar2">
                    <div class="account2">
                        <a href="{{ url('user/profile') }}" style="text-decoration: none; cursor: pointer; text-align:center;">
                            <div class="image img-cir img-120">
                                <img src="{{ Auth::user()->foto_profil }}" alt="John Doe" />
                            </div>
                            <h4 class="name">{{ Auth::user()->nama_lengkap }}</h4>
                        </a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        </form>
                    </div>
                    <nav class="navbar-sidebar2">
                        <ul class="list-unstyled navbar__list">
                            <li class="{{ ($menu == 'home')?'active has-sub':'' }}">
                                <a href="{{ url('/') }}">
                                    <i class="fas fa-tachometer-alt"></i>Dashboard
                                </a>
                            </li>
                            <li class="{{ ($menu == 'pengurus')?'active has-sub':'' }}">
                                <a href="{{ url('/pengurus') }}">
                                    <i class="fas fa-user-tie"></i>Pengurus
                                </a>
                            </li>
                            <li class="{{ ($menu == 'nasabah')?'active has-sub':'' }}">
                                <a href="{{ url('/') }}">
                                    <i class="fas fa-users"></i>Nasabah
                                </a>
                            </li>
                            <li class="{{ ($menu == 'setoran')?'active has-sub':'' }}">
                                <a href="{{ url('/') }}">
                                    <i class="fas fa-leaf"></i>Setoran
                                </a>
                            </li>
                            <li class="{{ ($menu == 'penjualan')?'active has-sub':'' }}">
                                <a href="{{ url('/') }}">
                                    <i class="fas fa-hand-holding-usd"></i>Penjualan
                                </a>
                            </li>
                            <li class="{{ ($menu == 'keuangan')?'active has-sub':'' }}">
                                <a href="{{ url('/') }}">
                                    <i class="fas fa-dollar-sign"></i>Keuangan Bank
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <!-- END HEADER DESKTOP-->

            {{-- Content in here --}}
            @yield('container')
            {{-- End content --}}

            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2020 PondokProgrammer. All rights reserved. Template by <a href="{{ url('https://colorlib.com')}}">Colorlib</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ url('vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ url('vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{ url('vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{ url('vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{ url('vendor/wow/wow.min.js')}}"></script>
    <script src="{{ url('vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{ url('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{ url('vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{ url('vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{ url('vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{ url('vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{ url('vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{ url('vendor/select2/select2.min.js')}}">
    </script>
    <script src="{{ url('vendor/vector-map/jquery.vmap.js')}}"></script>
    <script src="{{ url('vendor/vector-map/jquery.vmap.min.js')}}"></script>
    <script src="{{ url('vendor/vector-map/jquery.vmap.sampledata.js')}}"></script>
    <script src="{{ url('vendor/vector-map/jquery.vmap.world.js')}}"></script>

    <!-- Main JS-->
    <script src="{{ url('js/main.js')}}"></script>

    @yield('script')

</body>

</html>
<!-- end document-->
