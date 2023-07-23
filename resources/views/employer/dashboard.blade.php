<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Employer Dashboard</title>
	<link rel="stylesheet" href="{{asset('css/employer-dashboard.css')}}">
	<link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
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
			<div class="jobcontainer">
				<table class="datatable jobs-table">
					<thead>
						<tr>
							<th>
								<input id="check_all" type="checkbox">Select All
							</th>
							<th>Job Title</th>
							<th>Candidates</th>
							<th>Test1</th>
							<th>Test2</th>
							<th>Job Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd_col">
							<td><input type="checkbox" name="row-check" value="1">Executive Administrative Assistant</td>
							<td></td>
							<td>American Tourist</td>
							<td>12000</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
						</tr>
						<tr class="even_col">
							<td><input type="checkbox" name="row-check" value="2">Data Encoder</td>
							<td>USB02</td>
							<td>EXP Portable Hard Drive</td>
							<td>5000</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
						</tr>
						<tr class="odd_col">
							<td><input type="checkbox" name="row-check" value="3">Executive Administrative Assistant</td>
							<td>SH03</td>
							<td>Shoes</td>
							<td>1000</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
						</tr>
						
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

	<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
	<script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
	<script>

		var datatable_job = $('.jobs-table').DataTable({
			"lengthChange": false,
			"iDisplayLength" : 10,
			"order": [[0, 'asc']],
		});

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

		$(function() {
			//If check_all checked then check all table rows
			$("#check_all").on("click", function() {
				if ($("input:checkbox").prop("checked")) {
					$("input:checkbox[name='row-check']").prop("checked", true);
				} else {
					$("input:checkbox[name='row-check']").prop("checked", false);
				}
			});

			// Check each table row checkbox
			$("input:checkbox[name='row-check']").on("change", function() {
				var total_check_boxes = $("input:checkbox[name='row-check']").length;
				var total_checked_boxes = $("input:checkbox[name='row-check']:checked").length;

				// If all checked manually then check check_all checkbox
				if (total_check_boxes === total_checked_boxes) {
					$("#check_all").prop("checked", true);
				} else {
					$("#check_all").prop("checked", false);
				}
			});
		});
	</script>

</body>

</html>