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
                <div class="form-wrapper">
                    <img src="{{asset('./img/nafrica.png')}}" alt="" style="margin-bottom:20px;">
                    <form action="{{route('register')}}" method="POST" enctype="application/x-www-form-urlencoded" autocomplete="off" >
                        @csrf
                        <div class="vertical-form-group">
                            <label for="username" class="reg-label">Name:</label>
                            <input type="text" name="name"
                                   id="username"
                                   value="{{old('name')}}"
                                   class="form-control">
                            @error('name')
                            <span class="is-invalid" role="alert">
                             <strong>{{$message}}</strong>
                         </span>
                            @enderror
                        </div>
                        <div class="vertical-form-group">
                            <label for="email" class="reg-label">Email:</label>
                            <input type="email" name="email" id="email" value="{{old('email')}}"  class="form-control">
                            @error('email')
                            <span class="is-invalid" role="alert">
                             <strong>{{$message}}</strong>
                         </span>
                            @enderror
                        </div>
                        <div class="vertical-form-group">
                            <label for="password" class="reg-label">password:</label>
                            <input type="password" name="password" id="password"  class="form-control">
                            @error('password')
                            <span class="is-invalid" role="alert">
                             <strong>{{$message}}</strong>
                         </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirm" class="reg-label">confirm password:</label>
                            <input type="password" name="password_confirmation" id="password_confirm" class="form-control">
                        </div>

                        <input type="submit"  value="register" name="register" class="btn-register">
                    </form>
                    <div class="form-advice">
                        <p>Already have a account? </p>
                        <a href="/login" class="advice-link"> Login</a>
                    </div>

                </div>
            </section>
        </div>
    </body>
</html>
