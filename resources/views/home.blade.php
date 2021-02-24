@include('header')
<main class="container">
    <section class="banner">
        <div class="welcome-section">
            <h2>Hi {{\Illuminate\Support\Facades\Auth::user()->name}}</h2>
        </div>
    </section>
    <section class="search-wrapper">
        <form action="/search" method="POST" class="search-form">
            @csrf
            <input type="search" name="search" placeholder="search here" class="search-form-control">
            <select name="search_type" class="search-dropdown" >
                <option value="owner">Mine</option>
                <option value="all">All</option>
            </select>
            <button type="submit" class="btn-search">search</button>
        </form>
        @error('search')
        <span class="is-invalid" role="alert">
                     <strong>{{$message}}</strong>
                 </span>
        @enderror
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
       @include('footer')

    </div>
</body>
</html>
