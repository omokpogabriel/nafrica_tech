@include('header')
    <main class="container">
        <section class="banner"></section>
        <section class="profile-content">
              <a href="/home" class="btn_back"> < Home</a>
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
    @include('footer')
</div>
</body>
</html>
