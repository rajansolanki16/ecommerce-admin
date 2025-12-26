<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $meta['title'] ?? "Knoght Oasis" }}</title>
    <meta property="og:title" content="{{ $meta['title'] ?? "Knoght Oasis" }}">
    <meta name="twitter:title" content="{{ $meta['title'] ?? "Knoght Oasis" }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $meta['description'] }}">
    <meta property="og:description" content="{{ $meta['description'] }}">

    <link rel="shortcut icon" href="{{ publicPath(getSetting("site_icon")) }}">
    <meta property="og:image" content="{{ publicPath(getSetting("site_icon")) }}">
    <meta name="twitter:image" content="{{ publicPath(getSetting("site_icon")) }}">
    <meta name="twitter:card" content="{{ publicPath(getSetting("site_icon")) }}">

    @if(isset($meta['sco-allow']) && $meta['sco-allow'] == false)
    <meta name="robots" content="noindex, nofollow">
    @else
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    @endif

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="renderer" content="webkit">
    {{-- {!!getSetting('page_custom_script_header') !!} --}}
    <link rel="stylesheet" href="{{ publicPath('assets/css/custom-style.css') }}?version={{ rand(10,99) }}.{{ rand(10,99) }}.{{ rand(100,999) }} ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Marcellus&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">



</head>

<body>
    <header class="ecom-header sticky-top bg-white shadow-sm">
        <div class="container">

            <!-- TOP BAR -->
            <div class="d-flex align-items-center justify-content-between py-3">

                <!-- LOGO -->
                <a href="/" class="ecom-logo text-decoration-none">
                    <img src="{{ publicPath(getSetting('site_logo')) }}"
                        alt="Logo"
                        height="40">
                </a>

                <!-- SEARCH -->
                <form action="#"
                    method="GET"
                    class="ecom-search d-none d-lg-flex">
                    <input type="text"
                        name="q"
                        class="form-control"
                        placeholder="Search for products...">
                    <button class="btn btn-dark">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                <!-- ACTIONS -->
                <div class="ecom-actions d-flex align-items-center gap-3">

                    <!-- Wishlist -->
                    <!-- <a href="{{ route('wishlist.index') }}" class="icon-btn">
                    <i class="bi bi-heart"></i>
                    <span class="count">{{ auth()->check() ? auth()->user()->wishlist_count ?? 0 : 0 }}</span>
                </a> -->
                    <a  href="{{ route('wishlist.index') }}" class="icon-btn">
                        <i class="bi bi-heart"></i>
                        <span class="count" id="wishlist-count">
                            {{auth()->check() ? auth()->user()->wishlists()->count() : 0  }}
                        </span>
                    </a>

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="icon-btn">
                        <i class="bi bi-cart3"></i>
                        <span class="count cart-count">0</span>
                    </a>

                    <!-- Account -->
                    @auth
                    <div class="dropdown">
                        <a class="icon-btn dropdown-toggle"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-person"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">My Account</a></li>
                            <li><a class="dropdown-item" href="#">My Orders</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-danger"
                                    href="{{ route('auth.logout') }}">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-outline-dark btn-sm">
                        Login
                    </a>
                    @endauth
                </div>
            </div>

            <!-- CATEGORY NAV -->
            @php
            $categories = \App\Models\Category::orderBy('name')->get();
            @endphp
            <nav class="ecom-nav border-top">
                <ul class="nav gap-3 py-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.home') }}">All Products</a>
                    </li>

                    @foreach($categories ?? [] as $category)
                    <li class="nav-item">
                        <a class="nav-link"
                            href="#">
                            {{ $category->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </nav>

        </div>
    </header>