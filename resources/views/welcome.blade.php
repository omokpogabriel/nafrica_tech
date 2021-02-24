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
    </head>
    <body>
        <div class="container">
            <form action="{{route('login')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="{{old('email')}}">
                    @error('email')
                    <span class="is-invalid" role="alert">
                             <strong>{{$message}}</strong>
                         </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password">
                    @error('password')
                    <span class="is-invalid" role="alert">
                             <strong>{{$message}}</strong>
                         </span>
                    @enderror
                </div>
                <div class="form-group">
                   <button role="button" type="submit"> Login</button>
                </div>
            </form>

            <section style="margin:auto;padding:10px; display:flex;width:50%;border:1px solid red;">
                <form action="{{route('register')}}" method="POST" enctype="application/x-www-form-urlencoded"autocomplete="off" >
                  @csrf
                    <div class="form-group">
                        <label for="username">Name:</label>
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
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="{{old('email')}}">
                        @error('email')
                        <span class="is-invalid" role="alert">
                             <strong>{{$message}}</strong>
                         </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile:</label>
                        <input type="number" name="mobile" id="mobile" value="{{old('mobile')}}">
                        @error('mobile')
                        <span class="is-invalid" role="alert">
                             <strong>{{$message}}</strong>
                         </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" name="country" id="country" value="{{old('country')}}">
                        @error('country')
                        <span class="is-invalid" role="alert">
                             <strong>{{$message}}</strong>
                         </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">password:</label>
                        <input type="password" name="password" id="password">
                        @error('password')
                        <span class="is-invalid" role="alert">
                             <strong>{{$message}}</strong>
                         </span>
                        @enderror
                    </div>
                        <div class="form-group">
                            <label for="password_confirm">confirm password:</label>
                            <input type="password" name="password_confirmation" id="password_confirm">
                        </div>
                    <div class="form-group">
                        <input type="submit" role="button" value="register">
                    </div>
                </form>
            </section>
        </div>
    </body>
</html>
