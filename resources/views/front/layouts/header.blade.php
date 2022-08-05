<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title', $setting->title)</title>
    <meta name="description" content="{{ $setting->description }}">
    <meta name="keywords" content="{{ $setting->keywords }}">
    <meta name="author" content="{{ $setting->author }}">

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- ** Plugins Needed for the Project ** -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('front') }}/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/plugins/fontawesome/css/all.css">

    <!-- Main Stylesheet -->
    <link href="{{ asset('front') }}/css/style.css" rel="stylesheet">

    <!--Favicon-->
    <link rel="shortcut icon" href="{{  asset('').$setting->favicon }}" type="image/x-icon">
    <link rel="icon" href="{{  asset('').$setting->favicon }}" type="image/x-icon">

</head>

<body>
    <!-- START preloader-wrapper -->
    <div class="preloader-wrapper">
        <div class="preloader-inner">
            <div class="spinner-border text-red"></div>
        </div>
    </div>
    <!-- END preloader-wrapper -->

    <!-- START main-wrapper -->
    <section class="d-flex">

        <!-- start of sidenav -->
        <aside>
            <div class="sidenav position-sticky d-flex flex-column justify-content-between">
                <a class="navbar-brand" href="{{ route('home') }}" class="logo">
                    <img style="width: 100px"  src="{{ asset('').$setting->logo }}" alt="Logo">
                </a>
                <!-- end of navbar-brand -->

                <div class="navbar navbar-dark my-4 p-0 font-primary">
                    <ul class="navbar-nav w-100">
                        <li class="nav-item @if (!Request::segment(1)) active @endif">
                            <a class="nav-link text-white px-0 pt-0" href="{{ route('home') }}">Anasayfa</a>
                        </li>

                        @foreach ($pages as $page)                            
                            <li class="nav-item @if (Request::segment(1) == $page->slug && !Request::segment(2)) active @endif">
                                <a class="nav-link text-white px-0" href="{{ route('page', $page->slug) }}">{{ $page->title }}</a>
                            </li>
                        @endforeach

                        <li class="nav-item @if (Request::segment(1) == 'iletisim') active @endif">
                            <a class="nav-link text-white px-0" href="{{ route('contact') }}">İletişim</a>
                        </li>
                    </ul>
                </div>
                <!-- end of navbar -->

                <ul class="list-inline nml-2">
                    @if ($setting->facebook)
                    <li class="list-inline-item">
                        <a href="{{ $setting->facebook }}" target="_blank" class="text-white text-red-onHover p-2">
                            <span class="fab fa-facebook-f"></span>
                        </a>
                    </li>
                    @endif
                    @if ($setting->twitter)
                    <li class="list-inline-item">
                        <a href="{{ $setting->twitter }}" target="_blank" class="text-white text-red-onHover pr-2">
                            <span class="fab fa-twitter"></span>
                        </a>
                    </li>
                    @endif
                    @if ($setting->instagram)
                    <li class="list-inline-item">
                        <a href="{{ $setting->instagram }}" target="_blank" class="text-white text-red-onHover p-2">
                            <span class="fab fa-instagram"></span>
                        </a>
                    </li>
                    @endif
                    @if ($setting->youtube)
                    <li class="list-inline-item">
                        <a href="{{ $setting->youtube }}" target="_blank" class="text-white text-red-onHover p-2">
                            <span class="fab fa-youtube"></span>
                        </a>
                    </li>
                    @endif
                    @if ($setting->github)
                    <li class="list-inline-item">
                        <a href="{{ $setting->github }}" target="_blank" class="text-white text-red-onHover p-2">
                            <span class="fab fa-github"></span>
                        </a>
                    </li>
                    @endif
                    @if ($setting->linkedin)
                    <li class="list-inline-item">
                        <a href="{{ $setting->linkedin }}" target="_blank" class="text-white text-red-onHover p-2">
                            <span class="fab fa-linkedin-in"></span>
                        </a>
                    </li>
                    @endif
                </ul>
                <!-- end of social-links -->
            </div>
        </aside>
        <!-- end of sidenav -->
        <div class="main-content">
            <!-- start of mobile-nav -->
            <header class="mobile-nav pt-4">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <a href="{{ route('home') }}">
                                <img style="width: 50px" src="{{ asset('').$setting->logo }}" alt="Logo">
                            </a>
                        </div>
                        <div class="col-6 text-right">
                            <button class="nav-toggle bg-transparent border text-white">
                                <span class="fas fa-bars"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>
            <div class="nav-toggle-overlay"></div>
            <!-- end of mobile-nav -->
            <div class="container py-4 my-5">
                <div class="row">
                    <div class="col-lg-5 col-md-8">
                        <form class="search-form" action="#">
                            <div class="input-group">
                                <input type="search" class="form-control bg-transparent shadow-none rounded-0" placeholder="Search here">
                                <div class="input-group-append">
                                    <button class="btn" type="submit">
                                        <span class="fas fa-search"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row justify-content-between">