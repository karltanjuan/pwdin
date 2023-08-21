<nav class="sidebar">
    <div class="logo">
        <div class="logo-image">
            <img class="pwdin-logo" src="{{asset('img/logo.png')}}" alt="PWDIn Logo">
        </div>
        <div class="logo-name">{{env('APP_NAME')}}</div>
    </div>
    <div class="menu-items">
        <ul class="navLinks">
            <li class="{{ 'admin/dashboard' == request()->path() ? 'active' : '' }} navList">
                <a href="{{url('/admin/dashboard')}}">
                    <i class="fa-solid fa-gauge fa-icon"></i>
                    <span class="links">Dashboard</span>
                </a>
            </li>
            <li class="{{ 'admin/jobs' == request()->path() ? 'active' : '' }} navList">
                <a href="{{url('/admin/jobs')}}">
                     <i class="fa-solid fa-briefcase fa-icon"></i>
                    <span class="links">Jobs</span>
                </a>
            </li>
            <li class="{{ 'admin/employers' == request()->path() ? 'active' : '' }} navList">
                <a href="{{url('/admin/employers')}}">
                    <i class="fa-solid fa-building-user fa-icon"></i>
                    <span class="links">Employers</span>
                </a>
            </li>
            <li class="{{ 'admin/applicants' == request()->path() ? 'active' : '' }} navList">
                <a href="{{url('/admin/applicants')}}">
                    <i class="fa-solid fa-people-line fa-icon"></i>
                    <span class="links">Applicants</span>
                </a>
            </li>
            <li class="{{ 'admin/blogs' == request()->path() ? 'active' : '' }} navList">
                <a href="{{url('/admin/blogs')}}">
                    <i class="fa-solid fa-comment fa-icon"></i>
                    <span class="links">Blogs</span>
                </a>
            </li>
            <li class="{{ in_array(request()->path(), ['admin/change-password']) ? 'active' : '' }} navList settings-dropdown">
                <a href="javascript:void(0)">
                    <i class="fa-solid fa-gear fa-icon"></i>
                    <span class="links">Settings</span>
                    <i class="fa-solid fa-caret-right fa-icon"></i>
                </a>
            </li>
            
            <ul class="settings-dropdown-list">
                <li>
                    <a href="{{url('/admin/profile-info')}}">
                        <i class="fa-solid fa-circle-info fa-icon"></i>
                        <span class="links">Profile Info</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/admin/users')}}">
                        <i class="fa-solid fa-user-secret fa-icon"></i>
                        <span class="links">Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/admin/change-password')}}">
                        <i class="fa-solid fa-key fa-icon"></i>
                        <span class="links">Change Password</span>
                    </a>
                </li>
            </ul>
        </ul>
        <ul class="bottom-link">
            <li>
                <a href="{{url('/admin/logout')}}">
                    <i class="fa-solid fa-right-from-bracket fa-icon"></i>
                    <span class="links">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>