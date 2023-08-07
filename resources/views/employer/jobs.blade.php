@extends('employer.layouts.master')

@section('title', 'Employer Job Post')

@section('content')
	<style>
		.modal-view-job .content > div {
			border: 1px solid #333;
			padding: 5px;
		}

		.modal-view-job .content > div:last-child > div {
			padding-left: 30px;
		}
	</style>

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
					  <input class="check-all" type="checkbox">
					  <span class="checkmark"></span>
					</label>
				</th>
				<th>Job Title</th>
				<th>Total Candidates</th>
				<th>Hired</th>
				<th>Rejected</th>
				<th>Job Status</th>
				<th>Posted</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@if (count($jobs) > 0)
				@foreach ($jobs as $job)
				<tr class="odd_col">
					<td>
						<label class="container-checkbox">
						  <input type="checkbox">
						  <span class="checkmark"></span>
						</label>
					</td>
					<td>{{ $job->job_title }}</td>
					<td><a href="#">35</a></td>
					<td><a href="#">4</a></td>
					<td><a href="#">1</a></td>
					<td>{{ $job->status == 1 ? 'Open' : 'Close' }}</td>
					<td>{{ date('m/d/y', strtotime($job->created_at))}}</td>
					<td>
						<button class="btn-edit" id="btn-edit" data-id="{{ $job->id }}">
							<i class="fa-regular fa-pen-to-square"></i>
						</button>
						<button class="btn-delete" id="btn-delete" data-id="{{ $job->id }}">
							<i class="fa-regular fa-trash-can"></i>
						</button>
						<button class="btn-view" id="btn-view" data-id="{{ $job->id }}">
							<i class="fa-regular fa-eye"></i>
						</button>
					</td>
				</tr>
				@endforeach
			@else
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="text-center">No records found.</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			@endif
	</tbody>
	</table>
	
	<!-- modal -->
	<div id="modal-add-job" class="modal modal-add-job">
		<!-- Modal content -->
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title">Post Job</h2>
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
								<div class="input-field">
									<label>Working Days</label>
									<select class="working_days" id="working_days" name="working_days[]" multiple="multiple">
										<option value="Monday">Monday</option>
										<option value="Tuesday">Tuesday</option>
										<option value="Wednesday">Wednesday</option>
										<option value="Thursday">Thursday</option>
										<option value="Friday">Friday</option>
										<option value="Saturday">Saturday</option>
										<option value="Sunday">Sunday</option>
									</select>
									<span class="err-working_days err-msg"></span>
								</div>
								<div class="input-field">
									<label>PWD Categories</label>
									<select class="pwd_categories" id="pwd_categories" name="pwd_categories[]" multiple="multiple">
										<option value="All">All</option>
										<option value="Psychosocial">Psychosocial</option>
										<option value="Mental">Mental</option>
										<option value="Chronic illness">Chronic illness</option>
										<option value="Learning">Learning</option>
										<option value="Visual">Visual</option>
										<option value="Orthopedic">Orthopedic</option>
										<option value="Communication">Communication</option>
									</select>
									<span class="err-pwd_categories err-msg"></span>
								</div>
								<div class="input-field">
									<label>Status</label>
									<select class="status" id="status">
										<option value="1">Open</option>
										<option value="0">Closed</option>
									</select>
									<span class="err-status err-msg"></span>
								</div>
								<div class="input-field"></div>
							</div>
							<div class="input-field">
								<label>Job Description</label>
								<textarea rows="2" id="job_description" class="job_description" placeholder="Enter job description">Enter job description and optional disclaimer.</textarea>
								<span class="err-job_description err-msg"></span>
							</div>
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

	<div id="modal-delete-job" class="modal modal-delete-job">
		<div class="modal-content">
			<div class="modal-header">
				<h2>Delete Job</h2>
				<span class="modal-close">&times;</span>
			</div>
			<div class="modal-body">
				<div class="content">
					Are you sure you want to delete?
				</div>
				<div class="modal-footer">
					<button class="danger-btn btn-remove">Yes</button>
					<button class="secondary-btn btn-cancel">No</button>
				</div>
			</div>
		</div>
	</div>

	<div id="modal-view-job" class="modal modal-view-job">
		<div class="modal-content">
			<div class="modal-header">
				<h2>View Job</h2>
				<span class="modal-close">&times;</span>
			</div>
			<div class="modal-body">
				<div class="content">
				</div>
				<div class="modal-footer">
					<button class="secondary-btn btn-cancel">Close</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		var id = 0;
		$(document).ready(function() {
			tinymce.init({
				selector: 'textarea#job_description',
				plugins: 'powerpaste advcode table lists checklist emoticons',
				toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table | emoticons'
		   	});

			$('.working_days').select2();
			$('.pwd_categories').select2();
		})

		$(".check-all").click(function() {
            var isChecked = $(this).prop("checked");
            $("input[type='checkbox']").prop("checked", isChecked);
        });

        $("input[type='checkbox']:not(.check-all)").click(function() {
            var other_checkbox = ($("input[type='checkbox']:not(.check-all)").length === $("input[type='checkbox']:not(.check-all):checked").length);
            $(".check-all").prop("checked", other_checkbox);
        });

        function getJobsById(id) {
        	var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
        	formData.append('id', parseInt(id));

            // Send an AJAX request to validate the data
            $.ajax({
                url: '{{ route('employer.getJobsById') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('.job_title').val(response.job_title)
                    $('.career_level').val(response.career_level)
                    $('.job_type').val(response.job_type)
                    $('.job_industry').val(response.job_industry)
                    $('.years_experience').val(response.years_experience)
                    $('.average_processing_time').val(response.average_processing_time)
                    $('.salary').val(response.salary)
                    $('.qualification').val(response.qualification)
                    $('.work_setup').val(response.work_setup)
                    $('.working_days').val(response.working_days.split(",").map(item => item.trim()))
                    $('.working_days').trigger('change');
                    $('.pwd_categories').val(response.pwd_categories.split(",").map(item => item.trim()))
                    $('.pwd_categories').trigger('change');

                    tinymce.get('job_description').setContent(response.job_description);
                    $('.status').val(response.status)

                    var status = "Closed";

                    if (response.status == 1) {
                    	status = "Open"
                    }

                    const salary = parseFloat(response.salary).toLocaleString(undefined, {
					  style: 'currency',
					  currency: 'PHP', 
					});

                    $('.modal-view-job .content').html(`
                    	<div>Job Title: ${response.job_title}</div>
						<div>Career Level: ${response.career_level}</div>
						<div>Job Type: ${response.job_type}</div>
						<div>Industry: ${response.job_industry}</div>
						<div>Years of Experience: ${response.years_experience}</div>
						<div>Average Processing Days: ${response.average_processing_time}</div>
						<div>Salary: ${salary}</div>
						<div>Educational Attainment: ${response.qualification}</div>
						<div>Work Setup: ${response.work_setup}</div>
						<div>Working Days: ${response.working_days}</div>
						<div>Allowed Disability: ${response.pwd_categories}</div>
						<div>Status: ${status}</div>
						<div>Job Description: <div>${response.job_description}</div></div>
                    `)
                },
                error: function(xhr, status, error) {
                    var result = JSON.parse(xhr.responseText)
                    console.log(result.errors)
                }
            });
        }

		$(document).on('click', '.btn-add', function() {
			$('.modal-title').text('Post Job')
			$('.btn-save').text('Save')

			$('.job_title').val('')
            $('.career_level').val('Intern Level')
            $('.job_type').val('Full-time')
            $('.job_industry').val('Accounting/Finance')
            $('.years_experience').val('')
            $('.average_processing_time').val('')
            $('.salary').val('')
            $('.qualification').val('Grade School')
            $('.work_setup').val('Onsite')
            $('.working_days').val('')
            $('.working_days').trigger('change');
            $('.pwd_categories').val('')
            $('.pwd_categories').trigger('change');
            tinymce.get('job_description').setContent('');
            $('.status').val(1)

			$('.modal-add-job').show();
		})

		$(document).on('click', '.btn-edit', function() {
			$('.modal-title').text('Edit Job')
			$('.btn-save').text('Update')
			id = $(this).data('id')
			getJobsById(id)
			$('.modal-add-job').show();
		})

		$(document).on('click', '.btn-delete', function() {
			id = $(this).data('id')
			$('.modal-delete-job').show();
		})

		$(document).on('click', '.btn-view', function() {
			id = $(this).data('id')
			getJobsById(id)
			$('.modal-view-job').show();
		})

		$(document).on('click', '.btn-remove', function() {
			var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
        	formData.append('id', parseInt(id));

            // Send an AJAX request to validate the data
            $.ajax({
                url: '{{ route('employer.deleteJob') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                    	$('.modal').hide()

                        Swal.fire({
                          title: 'Job Post Deleted',
                          text: 'Success',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonText: 'OK'
                        });

                        setTimeout(function() {
                            window.location.href = '{{url('/employer/jobs')}}'
                        }, 2000)
                    } else {
                        displayErrors(JSON.parse(response.errors));
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the AJAX request error
                    var result = JSON.parse(xhr.responseText)
                    displayErrors(result.errors)
                }
            });
		})

		function closeModal() {
            $(".modal").css("display", "none");
        }

        $(document).on('click', '.modal-close, .btn-cancel', function() {
            closeModal()
        })

		var datatable_job = $('.jobs-table').DataTable({
			"lengthChange": false,
			"iDisplayLength" : 10,
			// "order": [[0, 'asc']],
		});

		var err_counter = 0;
        function displayErrors(errors) {
            $('.err-msg').text('');
            $('.err-msg').siblings('input, select').removeClass('error');

            // loop all the error messages from backend to display on ui
            $.each(errors, function(field, messages) {
                var errMsgSelector = '.err-' + field;
                var inputSelector = '#' + field;
                $(errMsgSelector).text(messages[0]);
                $(inputSelector).addClass('error');
            });

            $("html, body").animate({ scrollTop: 0 }, "slow");
        }

        
        $('.btn-save').on('click', function() {



            // data to be uploaded on ajax
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', id);
        	formData.append('job_title', $('#job_title').val());
			formData.append('career_level', $('#career_level').val());
			formData.append('job_type', $('#job_type').val());
			formData.append('job_industry',  $('#job_industry').val());
			formData.append('years_experience', $('#years_experience').val());
			formData.append('average_processing_time', $('#average_processing_time').val());
			formData.append('salary',  $('#salary').val());
			formData.append('qualification', $('#qualification').val());
			formData.append('work_setup', $('#work_setup').val());
			formData.append('working_days', $('#working_days').val().join());
			formData.append('pwd_categories', $('#pwd_categories').val().join());
			formData.append('job_description', tinymce.get("job_description").getContent());
			formData.append('status', $('#status').val());

			if ($(this).text() == "Save") {
	            var url = '{{ route('employer.postJob') }}'
	            event = "save"
	        } else {
	            var url ='{{ route('employer.updateJob') }}'
	            event = "update"
	        }

            // Send an AJAX request to validate the data
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                    	$('.modal').hide()

                    	var modal_title = ""
                    	if (event == "save") {
                    		modal_title = 'Job Post Created'
                    	} else {
                    		modal_title = 'Job Post Updated'
                    	}

                        Swal.fire({
                          title: modal_title,
                          text: 'Success',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonText: 'OK'
                        });

                        setTimeout(function() {
                            window.location.href = '{{url('/employer/jobs')}}'
                        }, 2000)
                    } else {
                        displayErrors(JSON.parse(response.errors));
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the AJAX request error
                    var result = JSON.parse(xhr.responseText)
                    displayErrors(result.errors)
                }
            });
   
        })
	</script>
@endsection