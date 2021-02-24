<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="content-wrapper">

    <section class="g-wrapper bounce">

        <div class="form-wrapper ">
            <form action="{{route('login')}}" method="POST" enctype="application/x-www-form-urlencoded" autocomplete="off" >
                @csrf
                <div class="vertical-form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control">
                    @error('email')
                    <span class="is-invalid" role="alert">
                             <strong>{{$message}}</strong>
                         </span>
                    @enderror
                </div>
                <div class="vertical-form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control">
                    @error('password')
                    <span class="is-invalid" role="alert">
                             <strong>{{$message}}</strong>
                         </span>
                    @enderror
                </div>

                <input type="submit"  value="Login" name="login" class="btn-register">
            </form>
            <div class="form-advice">
                <p>You don;t have an account? </p>
                <a href="/" class="advice-link"> Register</a>
            </div>

        </div>

        <img src="{{asset('./img/login_img.jpg')}}" alt="" class="g-image">
    </section>
</div>
</body>
</html>
