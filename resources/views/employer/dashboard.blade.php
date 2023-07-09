<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Employer Dashboard</title>
	<link rel="stylesheet" href="{{asset('css/employer-dashboard.css')}}">
</head>

<body>
	<div class="grid-fluid">
		<div class="row">
			<div class="col-tab-12">
				<!-- Navbar -->
				<nav class="navbar">
					<div class="navbar-">
						<a href="#">
							<img src="{{asset('img/logo.png')}}" class="logo" />
						</a>
						<div class="navbar-buttons">
							<a href="home">Dashboard</a>
							<a href="job_seeker">Help</a>
							<a href="employer">Notifications</a>
						</div>
					</div>
					<div class="navbar-right">
						<div class="employer-company">
							<p>Company Name</p>
							<p>Owner name: (Test)</p>
						</div>
						<div class="employer-icon">
							<img src="{{asset('img/avatar.png')}}" alt="">
							<p>Employer</p>
						</div>
					</div>
				</nav>
			</div>
		</div>

		<div class="row">
			<div class="activity-tabs">
				<a class="tab" href="">Jobs</a>
				<a class="tab" href="">Candidates</a>
				<a class="tab" href="">Messages</a>
			</div>
			<div class="search">
				<input type="text" placeholder="Search " name="search">
				<button>
					<i class="fa fa-search" style="font-size: 18px;">
					</i>
				</button>
			</div>
		</div>

		<div>
			<h2>Employer Dashboard</h2>
			<a href="{{route('employer.logout')}}">Logout</a>

		</div>
	</div>

</body>

</html>