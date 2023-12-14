<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="/" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
        <span>&nbsp;</span>
        <h1 class="m-0 text-primary">PWDIn</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
            <a href="{{ url('/applicant/applied-jobs') }}" class="nav-item nav-link">Applied Jobs</a>
            <a href="{{ url('/applicant/jobs') }}" class="nav-item nav-link">Job Post</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Settings</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="{{ url('/applicant/profile-info') }}" class="dropdown-item">Profile Info</a>
                    <a href="{{ url('/applicant/resume') }}" class="dropdown-item">Resume</a>
                    <a href="{{ url('/applicant/pwd-card') }}" class="dropdown-item">PWD Card</a>
                    <a href="{{ url('/applicant/change-password') }}" class="dropdown-item">Change Password</a>
                </div>
            </div>
        </div>
        <a href="{{ url('/applicant/logout') }}"
            class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Logout<i
                class="fa fa-arrow-right ms-3"></i></a>
    </div>
</nav>
