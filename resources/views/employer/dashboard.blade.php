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
			<div class="tab-">
				<div class="left-tab">
					<div class="activity-tabs">
						<a class="tablinks" onclick="openCity(event, 'Jobs')">Jobs</a>
						<a class="tablinks" onclick="openCity(event, 'Candidates')">Candidates</a>
						<a class="tablinks" onclick="openCity(event, 'Messages')">Messages</a>
						<a class="tablinks" onclick="openCity(event, 'Interviews')">Interviews</a>
					</div>
				</div>
				<div class="right-tab">
					<button class="solidButton">Post a Job</button>
				</div>
			</div>
		</div>

		<!-- <div>
			<h2>Employer Dashboard</h2>
			<a href="{{route('employer.logout')}}">Logout</a>

		</div> -->

		<div id="Jobs" class="tabcontent">
			<h3>Open and paused jobs (3)</h3>
			<input type="text" class="searchbar">
			<div class="jobcontainer">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th scope="col">Job Title</th>
							<th scope="col">Candidates</th>
							<th scope="col">Job Status</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="customCheck1">
									<label class="custom-control-label" for="customCheck1">1</label>
								</div>
							</td>
							<td>Bootstrap 4 CDN and Starter Template</td>
							<td>Cristina</td>
							<td>913</td>
							<td>2.846</td>
						</tr>
						<tr>
							<td>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="customCheck2">
									<label class="custom-control-label" for="customCheck2">2</label>
								</div>
							</td>
							<td>Bootstrap Grid 4 Tutorial and Examples</td>
							<td>Cristina</td>
							<td>1.434</td>
							<td>3.417</td>
						</tr>
						<tr>
							<td>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="customCheck3">
									<label class="custom-control-label" for="customCheck3">3</label>
								</div>
							</td>
							<td>Bootstrap Flexbox Tutorial and Examples</td>
							<td>Cristina</td>
							<td>1.877</td>
							<td>1.234</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div id="Candidates" class="tabcontent">
			<h3>Candidates</h3>
			<p>Paris is the capital of France.</p>
		</div>

		<div id="Messages" class="tabcontent">
			<h3>Messages</h3>
			<p>Tokyo is the capital of Japan.</p>
		</div>

		<div id="Interviews" class="tabcontent">
			<h3>Interviews</h3>
			<p>Incomplete is the capital of INC.</p>
		</div>
	</div>

	<script>
		function openCity(evt, cityName) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");
			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}
			tablinks = document.getElementsByClassName("tablinks");
			for (i = 0; i < tablinks.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" active", "");
			}
			document.getElementById(cityName).style.display = "block";
			evt.currentTarget.className += " active";
		}
	</script>

</body>

</html>