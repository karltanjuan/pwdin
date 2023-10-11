@extends('applicant.layouts.master')

@section('title', 'Applicant - Job List')

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
    	<h1 class="title-label">Available Jobs for Me</h1>
    </div>	
	<button class="primary-btn btn-filter-all">View All Jobs</button>
	<table class="jobs-table">
		<thead>
			<tr>
				<th>Job Title</th>
				<th>Company</th>
				<th>Job Status</th>
				<th>Application Status</th>
				<th>Date Posted</th>
				<th>Date Applied</th>
				<th>Date Updated</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@if (count($jobs) > 0)
				@foreach ($jobs as $job)
				<tr>
					<td>{{ $job->job_title }}</td>
					<td>{{ $job->employer->company_name }}</td>
					<td>{{ $job->status == 1 ? 'Open' : 'Close' }}</td>
					<td>{{ count($job->applications) > 0 ? $job->applications[0]->status : '-' }}</td>
					<td>{{ date('m/d/y H:i A', strtotime($job->created_at))}}</td>
					@if (count($job->applications) > 0)
						<td>{{ date('m/d/y H:i A', strtotime($job->applications[0]->created_at))}}</td>
						<td>{{ date('m/d/y H:i A', strtotime($job->applications[0]->updated_at))}}</td>
					@else
						<td>-</td>
						<td>-</td>
					@endif
					<td>
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
					<td class="text-center">No records found.</td>
					<td></td>
					<td></td>
				</tr>
			@endif
	</tbody>
	</table>
	
	<!-- modal -->

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
					<button class="primary-btn btn-withdraw">Withdraw</button>
					<button class="primary-btn btn-apply">Apply</button>
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
		})

        function getJobsById(id) {
        	var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
        	formData.append('id', parseInt(id));

            // Send an AJAX request to validate the data
            $.ajax({
                url: '{{ route('applicant.getJobsById') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var status = "Closed";
                    if (response.status == 1) {
                    	status = "Open"
                    }

                    const salary = parseFloat(response.salary).toLocaleString(undefined, {
					  style: 'currency',
					  currency: 'PHP', 
					});

					const full_address = `${response.employer.address}, ${response.employer.province}, ${response.employer.city}, ${response.employer.zip_code}`

                    $('.modal-view-job .content').html(`
                    	<div>Company Name: ${response.employer.company_name}</div>
                    	<div>Address: ${full_address}</div>
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
						<div>Status: ${status}</div>
						<div>Job Description: <div>${response.job_description}</div></div>
						<div class="input-group cover_letter_container">
							<label for="cover_letter">Cover Letter</label>
							<textarea rows="10" class="cover_letter" id="cover_letter" placeholder="Enter cover letter (300 characters max)"></textarea>
							<span class="err-cover_letter err-msg"></span>
						</div>
                    `)

                    if (response.applications.length > 0 && response.applications[0].status !== 'Withdrawn') {
					    $('.btn-withdraw').show();
					    $('.btn-apply').hide();
					    $('.cover_letter_container').hide()
					} else {
						$('.cover_letter_container').show()
						$('.btn-withdraw').hide();
					    $('.btn-apply').show();
					}

                },
                error: function(xhr, status, error) {
                    var result = JSON.parse(xhr.responseText)
                    console.log(result.errors)
                }
            });
        }

		$(document).on('click', '.btn-view', function() {
			id = $(this).data('id')
			getJobsById(id)
			$('.modal-view-job').show();
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

		$(document).on('click', '.btn-apply', function() {
			var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('cover_letter', $('.cover_letter').val())
        	formData.append('job_id', parseInt(id));

            $.ajax({
                url: '{{ route('applicant.applyJob') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                    	$('.modal').hide()

                        Swal.fire({
                          title: 'Application submitted',
                          text: 'Success',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonText: 'OK'
                        });

                        setTimeout(function() {
                            window.location.href = '{{url('/applicant/jobs')}}'
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

		$(document).on('click', '.btn-withdraw', function() {
			var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
        	formData.append('job_id', parseInt(id));

            $.ajax({
                url: '{{ route('applicant.withdrawJob') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                    	$('.modal').hide()

                        Swal.fire({
                          title: 'Application withdraw',
                          text: 'Success',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonText: 'OK'
                        });

                        setTimeout(function() {
                            window.location.href = '{{url('/applicant/jobs')}}'
                        }, 2000)
                    } else {
                        displayErrors(JSON.parse(response.errors));
                    }
                },
                error: function(xhr, status, error) {
                    var result = JSON.parse(xhr.responseText)
                    displayErrors(result.errors)
                }
            });
		})

		$(document).on('click', '.btn-filter-all', function() {
			location.href = "{{url('applicant/jobs/all')}}"

			// if ($(this).text() == "View All Jobs") {
			// 	$('.title-label').text('All Jobs Available')
			// 	location.href = "{{url('applicant/jobs')}}"
			// } else {
			// 	$('.title-label').text('Available Jobs for Me')
				
			// }
        })
		
		var err_counter = 0;
        function displayErrors(errors) {
            $('.err-msg').text('');
            $('.err-msg').siblings('input, select').removeClass('error');

            $.each(errors, function(field, messages) {
                var errMsgSelector = '.err-' + field;
                var inputSelector = '#' + field;
                $(errMsgSelector).text(messages[0]);
                $(inputSelector).addClass('error');
            });

            $("html, body").animate({ scrollTop: 0 }, "slow");
        }

        function checkApplicationStatus() {

        }
	</script>
@endsection