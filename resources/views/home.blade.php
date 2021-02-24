<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="main-container">
        <nav>
            <div class="inner-nav">
                <div class="nav-brand">
                    <h2>NAfrica</h2>
                </div>
                <div class="nav-bar">
                    <a href="">Profile</a>
                    <a href="">Contact</a>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>

        <main class="container">
            <section class="banner">
                    <div class="welcome-section">
                            <h2>Hi {{\Illuminate\Support\Facades\Auth::user()->name}}</h2>
                    </div>
                </section>
            <section class="search-wrapper">
                <input type="search" name="search" placeholder="search here">
            </section>
            <section class="profile-content">
                <div class="profile-wrapper">
                    <div class="card-header">
                        <h3>Profile</h3>
                    </div>
                    <div class="profile-card-wrapper">
                        <div class="profile-card">
                            <h3 class="p-label">Name:</h3>
                            <span> {{$user_info->name}} </span>
                        </div>
                        <div class="profile-card">
                            <h3 class="p-label">Email:</h3>
                            <span> {{$user_info->email}}</span>
                        </div>
                        <div class="profile-card">
                            <h3 class="p-label">Mobile:</h3>
                            <span> {{$user_info->mobile}}</span>
                        </div>
                        <div class="profile-card">
                            <h3 class="p-label">Country:</h3>
                            <span> {{$user_info->country}}</span>
                        </div>
                    </div>
                    <div class="card-bottom">
                        <a class="btn btn-update btn-center" href="/update">Update</a>
                    </div>
                </div>
            </section>
            <newcompanybutton-component :user_info="{{$user_info}}">

            </newcompanybutton-component>
            
        </main>

    </div>
</body>
</html>
