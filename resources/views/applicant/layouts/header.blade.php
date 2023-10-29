<div class="container py-5 bg-dark applicant-page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Welcome {{ucwords(auth()->user()->username)}}!</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                @yield('cover_page')
            </ol>
        </nav>
    </div>
</div>
