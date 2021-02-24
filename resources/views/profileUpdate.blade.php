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
        <section class="banner"></section>
        <section class="profile-content">
            <div class="company-modal-wrapper bounce">
                <div class="company-modal-header company-card-header">
                    <h3>UPDATE PROFILE</h3>
                </div>
                <form action="/update" method="POST" class="add-company-form">
                    @csrf

                    <div class="vertical-form-group">
                        <label for="username">Name:</label>
                        <input type="text" name="name"
                               id="name"
                               value="{{$user_info->name}}"
                               class="form-control">
                        @error('name')
                        <span class="is-invalid" role="alert">
                             <strong>{{$message}}</strong>
                         </span>
                        @enderror

                    </div>
                    <div class="vertical-form-group">
                        <label for="mobile">Mobile:</label>
                        <input type="number" name="mobile" id="mobile"
                               value="{{$user_info->mobile}}" class="form-control">
                        @error('mobile')
                        <span class="is-invalid" role="alert">
                             <strong>{{$message}}</strong>
                         </span>
                        @enderror
                    </div>
                    <div class="vertical-form-group">
                        <label for="country">Country:</label>
                        <input type="text" name="country" id="country"
                               value="{{$user_info->country}}" class="form-control">
                        @error('country')
                        <span class="is-invalid" role="alert">
                             <strong>{{$message}}</strong>
                         </span>
                        @enderror
                    </div>

                    <div class="vertical-form-group">
                        <button role="button" type="submit" class="btn-center btn-update btn"> UPDATE PROFILE</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</div>
</body>
</html>
