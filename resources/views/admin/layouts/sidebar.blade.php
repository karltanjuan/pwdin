<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{url('/admin/dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <hr class="mb-0">
                <div class="sb-sidenav-menu-heading mt-0">Management</div>
                <a class="nav-link" href="{{url('/admin/jobs')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-briefcase"></i></div>
                    Jobs
                </a>
                <a class="nav-link" href="{{url('/admin/employers')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-building-user"></i></div>
                    Employers
                </a>
                <a class="nav-link" href="{{url('/admin/applicants')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-people-line"></i></div>
                    Applicants
                </a>
                <a class="nav-link" href="{{url('/admin/inquiries')}}">
                    <div class="sb-nav-link-icon"><i class="fa fa-comments" aria-hidden="true"></i></div>
                    Inquiries
                </a>
                <hr>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
                    Settings
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{url('/admin/profile-info')}}">
                            <i class="fa-solid fa-circle-info"></i>&nbsp;
                            Profile Info
                        </a>
                        <a class="nav-link" href="{{url('/admin/users')}}">
                            <i class="fa-solid fa-users-gear"></i>&nbsp;
                            Users
                        </a>
                        <a class="nav-link" href="{{url('/admin/change-password')}}">
                            <i class="fa-solid fa-key"></i>&nbsp;
                            Change Password
                        </a>
                        {{-- <a class="nav-link" href="{{url('/admin/activity-logs')}}">
                            <i class="fa-solid fa-rectangle-list"></i>&nbsp;
                            Activity Logs
                        </a> --}}
                        <a class="nav-link" href="{{url('/admin/logout')}}">
                            <i class="fa-solid fa-right-from-bracket"></i>&nbsp;
                            Logout
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:
                <span>{{auth()->guard('admins')->user()->username}}</span>
            </div>
        </div>
    </nav>
</div>