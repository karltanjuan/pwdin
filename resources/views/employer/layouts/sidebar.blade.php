<nav class="sidebar">
    <div class="logo">
        <div class="logo-image">
            <img class="pwdin-logo" src="{{asset('img/logo.png')}}" alt="PWDIn Logo">
        </div>
        <div class="logo-name">{{env('APP_NAME')}}</div>
    </div>
    <div class="menu-items">
        <ul class="navLinks">
            <li class="{{ 'employer/dashboard' == request()->path() ? 'active' : '' }} navList">
                <a href="{{url('/employer/dashboard')}}">
                    <i class="fa-solid fa-gauge fa-icon"></i>
                    <span class="links">Dashboard</span>
                </a>
            </li>
            <li class="{{ 'employer/jobs' == request()->path() ? 'active' : '' }} navList">
                <a href="{{url('/employer/jobs')}}">
                    <i class="fa-solid fa-briefcase fa-icon"></i>
                    <span class="links">Job Post</span>
                </a>
            </li>
            <li class="{{ in_array(request()->path(), ['employer/application-status', 'change-password']) ? 'active' : '' }} navList settings-dropdown">
                <a href="javascript:void(0)">
                    <i class="fa-solid fa-gear fa-icon"></i>
                    <span class="links">Settings</span>
                    <i class="fa-solid fa-caret-right fa-icon"></i>
                </a>
            </li>
            
            <ul class="settings-dropdown-list">
                <li>
                    <a href="{{url('/employer/application-status')}}">
                        <i class="fa-solid fa-clipboard-check fa-icon"></i>
                        <span class="links">Application Status</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/employer/company-info')}}">
                        <i class="fa-solid fa-circle-info fa-icon"></i>
                        <span class="links">Company Info</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/employer/business-permit')}}">
                        <i class="fa-solid fa-file fa-icon"></i>
                        <span class="links">Business Permit</span>
                    </a>
                </li>
                <li >
                    <a href="{{url('/employer/bir-certificate')}}">
                        <i class="fa-solid fa-certificate fa-icon"></i>
                        <span class="links">BIR Certificate</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/employer/change-password')}}">
                        <i class="fa-solid fa-key fa-icon"></i>
                        <span class="links">Change Password</span>
                    </a>
                </li>
            </ul>
        </ul>
        <ul class="bottom-link">
            <li>
                <a href="{{url('/employer/logout')}}">
                    <i class="fa-solid fa-right-from-bracket fa-icon"></i>
                    <span class="links">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>