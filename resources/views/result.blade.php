@include('header')
<main class="container">
    <section class="banner"></section>
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

    <section class="company-content">
        @forelse( $company as $key=>$companies)
        <div class="company-wrapper">
            <div class="company-card-header">
                <h3>Company @isset($loop) {{$loop->iteration}}@endisset</h3>
            </div>
            <div class="company-card-wrapper">
                <div class="company-card">
                    <h3 class="p-label">Name:</h3>
                    <span>{{$companies->company_name}}</span>
                </div>
                <div class="company-card">
                    <h3 class="p-label">Email:</h3>
                    <span>{{$companies->email}}</span>
                </div>
                <div class="company-card">
                    <h3 class="p-label">Country:</h3>
                    <span>{{$companies->country}}</span>
                </div>
            </div>
        </div>
            @empty
            <div class="company-card-header">
                <h3>no company found</h3>
            </div>
        @endforelse
    </section>

</main>
@include('footer')

</div>
</body>
</html>
