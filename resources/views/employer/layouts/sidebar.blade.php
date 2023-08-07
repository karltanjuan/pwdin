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
            <li class="navList settings-dropdown">
                <a href="javascript:void(0)">
                    <i class="fa-solid fa-gear fa-icon"></i>
                    <span class="links">Settings</span>
                    <i class="fa-solid fa-caret-right fa-icon"></i>
                    {{-- <i class="fa-solid fa-caret-down fa-icon"></i> --}}
                </a>
            </li>
            
            <ul class="settings-dropdown-list">
                <li class="{{ 'employer/app-status' == request()->path() ? 'active' : '' }} navList">
                    <a href="{{url('/employer/app-status')}}">
                        <i class="fa-solid fa-clipboard-check fa-icon"></i>
                        <span class="links">App Status</span>
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