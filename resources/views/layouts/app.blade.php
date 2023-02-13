<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MySchool') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link src="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
</head>

<body>
    <div id="app">
        <div class="row">
            <div class="container-fluid">
                <div class="sidebar">
                    <div class="sidebar-inner">
                        <div class="sidebar-logo">
                            <div class="peers ai-c fxw-nw">
                                <div class="peer peer-greed">
                                    <a class="sidebar-link td-n" href="/home">
                                        <div class="peers ai-c fxw-nw">
                                            <div class="peer">
                                                <div class="logo"><img src="" alt=""></div>
                                            </div>
                                            <div class="peer peer-greed">
                                                <h5 class="lh-1 mB-0 logo-text">MySchool</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="peer">
                                    <div class="mobile-toggle sidebar-toggle"><a href="" class="td-n"><i
                                                class="ti-arrow-circle-left"></i></a></div>
                                </div>
                            </div>
                        </div>
                        <ul class="sidebar-menu scrollable pos-r">
                            <li class="nav-item mT-30 actived"><a class="sidebar-link"
                                    href="{{ route('home') }}"><span class="icon-holder"><i
                                            class="c-blue-500 ti-home"></i> </span><span
                                        class="title">Dashdoard</span></a></li>
                            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span
                                        class="icon-holder"><i class="c-green-500 ti-layout-list-thumb"></i>
                                    </span><span class="title">Admins</span> <span class="arrow"><i
                                            class="ti-angle-right"></i></span></a>
                                <ul class="dropdown-menu">
                                    <li><a class="sidebar-link" href="{{ route('all-admin') }}">All admin</a>
                                    </li>
                                    <li><a class="sidebar-link" href="{{ route('create-admin') }}">Add Admin</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span
                                        class="icon-holder"><i class="c-orange-500 ti-layout-list-thumb"></i>
                                    </span><span class="title">Students</span> <span class="arrow"><i
                                            class="ti-angle-right"></i></span></a>
                                <ul class="dropdown-menu">
                                    <li><a class="sidebar-link" href="{{ route('all-students') }}">students</a>
                                    </li>
                                    <li><a class="sidebar-link" href="{{ route('create-student') }}">Add student</a>
                                    </li>
                                    <li>
                                        <form class="d-flex" role="search" method="POST"
                                            action="{{ route('find-student') }}">
                                            @csrf
                                            <input class="form-control me-2" type="search"
                                                placeholder="student full name" aria-label="Search" id="full_name"
                                                name="full_name">
                                            <button class="btn btn-outline-success" type="submit">Search</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span
                                        class="icon-holder"><i class="c-purple-500 ti-layout-list-thumb"></i>
                                    </span><span class="title">Employees</span> <span class="arrow"><i
                                            class="ti-angle-right"></i></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('all-masters') }}">Masters</a></li>
                                    <li><a href="{{ route('all-teachers') }}">Teachers</a></li>
                                    <li><a href="{{ route('create-master') }}">Add Master</a></li>
                                    <li><a href="{{ route('create-teacher') }}">Add Teacher</a></li>
                                    <li>
                                        <form class="d-flex" role="search" method="POST"
                                            action="{{ route('find-employee') }}">
                                            @csrf
                                            <input class="form-control me-2" type="search"
                                                placeholder="employee full name" aria-label="Search" id="full_name"
                                                name="full_name">
                                            <button class="btn btn-outline-success" type="submit">Search</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="sidebar-link" href="{{route('affiliation-employee')}}"><span
                                        class="icon-holder"><i class="c-brown-500 ti-email"></i> </span><span
                                        class="title">Affiliation Request Employee</span></a></li>
                            <li class="nav-item"><a class="sidebar-link" href="{{route('affiliation-student')}}"><span
                                        class="icon-holder"><i class="c-brown-500 ti-email"></i> </span><span
                                        class="title">Affiliation Request Student</span></a></li>
                            {{-- <li class="nav-item"><a class="sidebar-link" href="{{route('all-admin')}}"><span class="icon-holder"><i
                                            class="c-indigo-500 ti-bar-chart"></i>
                                    </span><span class="title">Admins</span></a></li> --}}
                            {{--<li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span
                                        class="icon-holder"><i class="c-red-500 ti-files"></i> </span><span
                                        class="title">Pages</span> <span class="arrow"><i
                                            class="ti-angle-right"></i></span></a>
                                <ul class="dropdown-menu">
                                    <li><a class="sidebar-link" href="/blank">Blank</a></li>
                                    <li><a class="sidebar-link" href="/404">404</a></li>
                                    <li><a class="sidebar-link" href="/500">500</a></li>
                                    <li><a class="sidebar-link" href="/signin">Sign In</a></li>
                                    <li><a class="sidebar-link" href="/signup">Sign Up</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span
                                        class="icon-holder"><i class="c-teal-500 ti-view-list-alt"></i> </span><span
                                        class="title">Multiple Levels</span> <span class="arrow"><i
                                            class="ti-angle-right"></i></span></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item dropdown"><a href="javascript:void(0);"><span>Menu
                                                Item</span></a></li>
                                    <li class="nav-item dropdown"><a href="javascript:void(0);"><span>Menu
                                                Item</span>
                                            <span class="arrow"><i class="ti-angle-right"></i></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);">Menu Item</a></li>
                                            <li><a href="javascript:void(0);">Menu Item</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li> --}}
                            <li class="nav-item"><a class="sidebar-link" href="{{ route('logout') }}"><span
                                        class="icon-holder"><i class="c-light-blue-500 ti-arrow-left"></i>
                                    </span><span class="title">Logout</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-container ">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
                            <button type="button" class="navbar-brand btn btn-outline-light"
                                onclick="history.back()">Go
                                Back
                            </button>
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('loggin') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif
                            @else
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('create-admin') }}">{{ 'create Admin' }}</a>
                                    </li>
                                @endif
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu  dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                        <ul class="dropdown" aria-labelledby="navbarDarkDropdownMenuLink">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('logout') }}">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="GET"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                {{-- <li>
                                    <form class="d-flex" role="search">
                                        <input class="form-control me-2" type="search" placeholder="Search"
                                            aria-label="Search">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </form>
                                </li> --}}
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="main">
                <div id="mainContent">
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            @if ($message = Session::get('faile'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bundle.js') }}"></script>
    @yield('scripts')
</body>

</html>
