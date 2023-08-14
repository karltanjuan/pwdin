<nav class="sidebar">
    <div class="logo">
        <div class="logo-image">
            <img class="pwdin-logo" src="{{asset('img/logo.png')}}" alt="PWDIn Logo">
        </div>
        <div class="logo-name">{{env('APP_NAME')}}</div>
    </div>
    <div class="menu-items">
        <ul class="navLinks">
            <li class="{{ 'applicant/dashboard' == request()->path() ? 'active' : '' }} navList">
                <a href="{{url('/applicant/dashboard')}}">
                    <i class="fa-solid fa-gauge fa-icon"></i>
                    <span class="links">Dashboard</span>
                </a>
            </li>
            <li class="{{ 'applicant/jobs' == request()->path() ? 'active' : '' }} navList">
                <a href="{{url('/applicant/jobs')}}">
                     <i class="fa-solid fa-briefcase fa-icon"></i>
                    <span class="links">Job Post</span>
                </a>
            </li>
            <li class="{{ in_array(request()->path(), ['applicant/change-password']) ? 'active' : '' }} navList settings-dropdown">
                <a href="javascript:void(0)">
                    <i class="fa-solid fa-gear fa-icon"></i>
                    <span class="links">Settings</span>
                    <i class="fa-solid fa-caret-right fa-icon"></i>
                </a>
            </li>
            
            <ul class="settings-dropdown-list">
                <li>
                    <a href="{{url('/applicant/profile-info')}}">
                        <i class="fa-solid fa-circle-info fa-icon"></i>
                        <span class="links">Profile Info</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/applicant/resume')}}">
                        <i class="fa-solid fa-file fa-icon"></i>
                        <span class="links">Resume</span>
                    </a>
                </li>
                <li >
                    <a href="{{url('/applicant/pwd-card')}}">
                        <i class="fa-solid fa-id-card fa-icon"></i>
                        <span class="links">PWD Card</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/applicant/change-password')}}">
                        <i class="fa-solid fa-key fa-icon"></i>
                        <span class="links">Change Password</span>
                    </a>
                </li>
            </ul>
        </ul>
        <ul class="bottom-link">
            <li>
                <a href="{{url('/applicant/logout')}}">
                    <i class="fa-solid fa-right-from-bracket fa-icon"></i>
                    <span class="links">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>