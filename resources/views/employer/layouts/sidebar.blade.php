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
                    <ion-icon name="home-outline"></ion-icon>
                    <span class="links">Dashboard</span>
                </a>
            </li>
            <li class="{{ 'employer/jobs' == request()->path() ? 'active' : '' }} navList">
                <a href="{{url('/employer/jobs')}}">
                    <ion-icon name="folder-outline"></ion-icon>
                    <span class="links">Job Post</span>
                </a>
            </li>
            <li class="navList">
                <a href="javascript:void(0)">
                    <ion-icon name="settings-outline"></ion-icon>
                    <span class="links">Settings</span>
                </a>
            </li>
        </ul>
        <ul class="bottom-link">
            <li>
                <a href="{{url('/employer/logout')}}">
                    <ion-icon name="log-out-outline"></ion-icon>
                    <span class="links">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>