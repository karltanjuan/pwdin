@extends('employer.layouts.master')

@section('title', 'Employer Job Post')

@section('content')
    <div class="head-container">
    	<h1>Job Post</h1>
    	<button class="btn-add primary-btn">
    		<span><i class="fa-solid fa-plus"></i> Post Job</span>
    	</button>
    </div>	

	<table class="jobs-table">
		<thead>
			<tr>
				<th>
					<label class="container-checkbox">
					  <input type="checkbox" checked="checked">
					  <span class="checkmark"></span>
					</label>
				</th>
				<th>Job Title</th>
				<th>Total Candidates</th>
				<th>Hired</th>
				<th>Rejected</th>
				<th>Job Status</th>
				<th>Created</th>
				<th>Closed</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<tr class="odd_col">
				<td>
					<label class="container-checkbox">
					  <input type="checkbox" checked="checked">
					  <span class="checkmark"></span>
					</label>
				</td>
				<td>Data Entry</td>
				<td><a href="#">35</a></td>
				<td><a href="#">4</a></td>
				<td><a href="#">1</a></td>
				<td>Open</td>
				<td>07/20/23</td>
				<td>N/A</td>
				<td>
					<button class="btn-edit" id="btn-edit" data-id="1">
						<i class="fa-regular fa-pen-to-square"></i>
					</button>
					<button class="btn-delete" id="btn-delete" data-id="1">
						<i class="fa-regular fa-trash-can"></i>
					</button>
					<button class="btn-view" id="btn-view" data-id="1">
						<i class="fa-regular fa-eye"></i>
					</button>
				</td>
			</tr>
	</tbody>
	</table>
	
	<!-- The modal -->
	<div id="modal-add-job" class="modal modal-add-job">
		<!-- Modal content -->
		<div class="modal-content">
			<div class="modal-header">
				<h2>Post Job</h2>
				<span class="modal-close">&times;</span>
			</div>
			<div class="modal-body">
				<div class="content">
				<div id="form">
					<div class="form first" id="form-first">
						<div class="details personal">
							<div class="fields">
								<div class="input-field">
									<label>Job Title</label>
									<input id="job_title" class="job_title" type="text" placeholder="Enter job title"/>
									<span class="err-job_title err-msg"></span>
								</div>
								<div class="input-field">
									<label>Career Level</label>
									<select class="career_level" id="career_level">
										<option value="Intern Level">Intern Level</option>
										<option value="Entry Level">Entry Level</option>
										<option value="Associate Level">Associate Level</option>
										<option value="Mid-Senior Level">Mid-Senior Level</option>
										<option value="Director">Director</option>
									</select>
									<span class="err-career_level err-msg"></span>
								</div>
								<div class="input-field">
									<label>Job Type</label>
									<select class="job_type" id="job_type">
										<option value="Full-time">Full-time</option>
										<option value="Part-time">Part-time</option>
										<option value="Internship">Internship</option>
										<option value="Contract">Contract</option>
									</select>
									<span class="err-job_type err-msg"></span>
								</div>
								<div class="input-field">
									<label>Industry</label>
									<select class="job_industry" id="job_industry">
										<option value="Accounting/Finance">Accounting/Finance</option>
										<option value="Admin/Human Resources">Admin/Human Resources</option>
										<option value="Sales/Marketing">Sales/Marketing</option>
										<option value="Arts/Media/Communication">Arts/Media/Communication</option>
										<option value="Services">Services</option>
										<option value="Hotel/Restaurant">Hotel/Restaurant</option>
										<option value="Education/Training">Education/Training</option>
										<option value="Computer/Information Technology">Computer/Information Technology</option>
										<option value="Engineering">Engineering</option>
										<option value="Manufacturing">Manufacturing</option>
										<option value="Building/Construction">Building/Construction</option>
										<option value="Sciences">Sciences</option>
										<option value="Healtcare">Healtcare</option>
										<option value="Journalist/Editors">Journalist/Editors</option>
										<option value="General Work">General Work</option>
										<option value="Publishing">Publishing</option>
										<option value="Others">Others</option>
									</select>
									<span class="err-job_industry err-msg"></span>
								</div>
								<div class="input-field">
									<label>Years of Experience</label>
									<input class="years_experience" id="years_experience" type="number" placeholder="Enter years of experience">
									<span class="err-years_experience err-msg"></span>
								</div>
								<div class="input-field">
									<label>Average Processing Days</label>
									<input class="average_processing_time" id="average_processing_time" type="number" placeholder="Enter days">
									<span class="err-average_processing_time err-msg"></span>
								</div>
								<div class="input-field d-flex">
									<label>Working Days</label>
									<label class="container-checkbox">
									  <input class="working_days" type="checkbox" value="Monday">
									  <span class="checkmark"></span>
									  <span>Monday</span>
									</label>
									<label class="container-checkbox">
									  <input class="working_days" type="checkbox" value="Tuesday">
									  <span class="checkmark"></span>
									  <span>Tuesday</span>
									</label>
									<label class="container-checkbox">
									  <input class="working_days" type="checkbox" value="Wednesday">
									  <span class="checkmark"></span>
									  <span>Wednesday</span>
									</label>
									<label class="container-checkbox">
									  <input class="working_days" type="checkbox" value="Thursday">
									  <span class="checkmark"></span>
									  <span>Thursday</span>
									</label>
									<label class="container-checkbox">
									  <input class="working_days" type="checkbox" value="Friday">
									  <span class="checkmark"></span>
									  <span>Friday</span>
									</label>
									<label class="container-checkbox">
									  <input class="working_days" type="checkbox" value="Saturday">
									  <span class="checkmark"></span>
									  <span>Saturday</span>
									</label>
									<label class="container-checkbox">
									  <input class="working_days" type="checkbox" value="Sunday">
									  <span class="checkmark"></span>
									  <span>Sunday</span>
									</label>
								</div>
								<div class="input-field">
									<label>Salary</label>
									<input class="salary" id="salary" type="number" placeholder="Enter salary">
									<span class="err-salary err-msg"></span>
								</div>
								<div class="input-field">
									<label>Educational Attainment</label>
									<select class="qualification" id="qualification">
										<option value="Grade School">Grade School</option>
										<option value="High School">High School</option>
										<option value="Bachelor's Degree">Bachelor's Degree</option>
										<option value="Vocational">Vocational</option>
										<option value="Post-Graduate">Post-Graduate</option>
										<option value="Others">Others</option>
									</select>
									<span class="err-qualification err-msg"></span>
								</div>
								<div class="input-field">
									<label>Work Setup</label>
									<select class="work_setup" id="work_setup">
										<option value="Onsite">Onsite</option>
										<option value="Remote">Remote</option>
										<option value="Hybrid">Hybrid</option>
									</select>
									<span class="err-work_setup err-msg"></span>
								</div>
							</div>
							<div class="input-field">
								<label>Job Description</label>
								<textarea rows="2" id="job_description" class="job_description" placeholder="Enter job description"></textarea>
								<span class="err-email err-msg"></span>
							</div>
					</div>
				</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="primary-btn btn-save">Save</button>
				<button class="secondary-btn btn-cancel">Cancel</button>
			</div>
		</div>
	</div>

	<script>

		$(document).ready(function() {
		
		})

		$(document).on('click', '.btn-add', function() {
			$('.modal-add-job').show();
		})

		tinymce.init({
	     selector: 'textarea#job_description',
	     plugins: 'powerpaste advcode table lists checklist emoticons',
	     toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table | emoticons'
	   });

		function closeModal() {
            $(".modal").css("display", "none");
        }

        $(document).on('click', '.modal-close, .btn-cancel', function() {
            closeModal()
        })

		var datatable_job = $('.jobs-table').DataTable({
			"lengthChange": false,
			"iDisplayLength" : 10,
			"order": [[0, 'asc']],
		});
	</script>
@endsection