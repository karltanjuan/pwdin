<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="/" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
        <img class="img-fluid logo" src="{{asset('img/logo.jpg')}}" alt="Logo"/>
        <span>&nbsp;</span>
        {{-- <h1 class="m-0 text-primary">PWDIn</h1> --}}
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ url('/employer/dashboard') }}" class="nav-item nav-link">Dashboard</a>
            <a href="{{ url('/employer/jobs') }}" class="nav-item nav-link">Job Post</a>
            <a href="{{ url('/employer/subscription') }}" class="nav-item nav-link">Subscription</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Settings</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="{{ url('/employer/company-info') }}" class="dropdown-item">Company Info</a>
                    <a href="{{ url('/employer/business-permit') }}" class="dropdown-item">Business Permit</a>
                    <a href="{{ url('/employer/bir-certificate') }}" class="dropdown-item">BIR Certificate</a>
                    <a href="{{ url('/employer/change-password') }}" class="dropdown-item">Change Password</a>
                </div>
            </div>
        </div>
        <a href="{{ url('/employer/logout') }}"
            class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Logout<i
                class="fa fa-arrow-right ms-3"></i></a>
    </div>
    
</nav>
