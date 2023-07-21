<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Dashboard</title>

	<!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

	<link rel="stylesheet" href="{{asset('css/admin-dashboard.css')}}">
</head>
<body>

	<nav>
        <div class="logo">
            <div class="logo-image">
                <img class="pwdin-logo" src="{{asset('img/logo.png')}}" alt="PWDIn Logo">
            </div>
            <div class="logo-name">
                PWDin
            </div>
        </div>

        <div class="menu-items">
            <ul class="navLinks">
                <li class="navList active">
                    <a href="#">
                        <ion-icon name="home-outline"></ion-icon>
                        <span class="links">Dashboard</span>
                    </a>
                </li>
                <li class="navList">
                    <a href="#">
                        <ion-icon name="folder-outline"></ion-icon>
                        <span class="links">Jobs</span>
                    </a>
                </li>
                <li class="navList">
                    <a href="#">
                        <ion-icon name="analytics-outline"></ion-icon>
                        <span class="links">Employers</span>
                    </a>
                </li>
                <li class="navList">
                    <a href="#">
                        <ion-icon name="heart-outline"></ion-icon>
                        <span class="links">Applicants</span>
                    </a>
                </li>
                <li class="navList">
                    <a href="#">
                        <ion-icon name="heart-outline"></ion-icon>
                        <span class="links">Messages</span>
                    </a>
                </li>
                <li class="navList">
                    <a href="#">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                        <span class="links">Blogs</span>
                    </a>
                </li>
            </ul>
            <ul class="bottom-link">
                <li>
                    <a href="{{url('/admin/logout')}}">
                        <ion-icon name="log-out-outline"></ion-icon>
                        <span class="links">Logout</span>
                    </a>
                </li>
                <li class="mode">
                    <a href="#">
                        <ion-icon name="moon-outline"></ion-icon>
                        <span class="links">Dark Mode</span>
                        <div class="darkToggle">
                            <span class="switch"></span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <ion-icon class="navToggle" name="menu-outline"></ion-icon>
            <div class="searchBox">
                <ion-icon name="search-outline"></ion-icon>
                <input type="text" placeholder="Search">
            </div>
            <img class="pwdin-logo" src="{{asset('img/logo.png')}}" alt="PWDIn Logo">
        </div>
        <div class="container">
            <div class="overview">
                <div class="title">
                    <ion-icon name="speedometer"></ion-icon>
                    <span class="text">Dashboard</span>
                </div>
                <div class="boxes">
                    <div class="box box1">
                        <ion-icon name="eye-outline"></ion-icon>
                        <span class="text">Total Jobs</span>
                        <span class="number">678</span>
                    </div>
                    <div class="box box2">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                        <span class="text">Total Employers</span>
                        <span class="number">430</span>
                    </div>
                    <div class="box box3">
                        <ion-icon name="arrow-redo-outline"></ion-icon>
                        <span class="text">Total Applicants</span>
                        <span class="number">780</span>
                    </div>
                </div>
            </div>
            <div class="activity">
                <div class="title">
                    <ion-icon name="time-outline"></ion-icon>
                    <span class="text">Recent Jobs</span>
                </div>
                <div class="activity-data">
                   
                </div>
            </div>
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script src="{{asset('js/admin-dashboard.js')}}"></script>
	
</body>
</html>