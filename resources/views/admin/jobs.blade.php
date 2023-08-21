@extends('admin.layouts.master')

@section('title', 'Admin - Jobs')

@section('content')
	<style>
		.modal-view-job .content > div {
			border: 1px solid #333;
			padding: 5px;
		}

		.modal-view-job .content > div:last-child > div {
			padding-left: 30px;
		}

		.close-badge,
        .open-badge,
        .rejected-badge {
        	width: 100px;
        	height: 100px;
        	padding: 10px;
        	border-radius: 50px;
        	font-size: 11px;
        }

        .close-badge {background: #757575;color: #fff;}
        .open-badge {background: #2e7d32;color: #fff;}
        .rejected-badge {background: #c62828;color: #fff;}
	</style>

    <div class="head-container">
    	<h1>Jobs</h1>
    </div>	

	<table class="jobs-table">
		<thead>
			<tr>
				<th>Job Title</th>
				<th>Company Name</th>
				<th>Job Status</th>
				<th>Date Posted</th>
				<th>Date Closed</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@if (count($jobs) > 0)
				@foreach ($jobs as $job)
				<tr>
					<td>{{ $job->job_title }}</td>
					<td>{{ $job->employer->company_name }}</td>
					<td>
						@if($job->status == 0)
							<span class="close-badge">Close</span>
						@elseif($job->status == 1)
							<span class="open-badge">Open</span>
						@elseif($job->status == 2)
							<span class="rejected-badge">Rejected</span>
						@endif
					</td>
					<td>{{ date('m/d/y', strtotime($job->created_at))}}</td>
					<td>
					    @if($job->closed_at)
					        <span>{{ date('m/d/y', strtotime($job->closed_at)) }}</span>
					    @else
					        <span>-</span>
					    @endif
					</td>
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
					<button class="secondary-btn btn-cancel">Close</button>
				</div>
			</div>
		</div>
	</div>

	<div id="modal-confirm-job" class="modal modal-confirm-job">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Update Job</h2>
                <span class="modal-close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="content">
                    Are you sure you want to continue?
                </div>
                <div class="modal-footer">
                    <button class="primary-btn btn-update">Yes</button>
                    <button class="secondary-btn btn-cancel">No</button>
                </div>
            </div>
        </div>
    </div>

	<script>
		var id = 0;
		$(document).ready(function() {
			
		})

        function getJobsById(id) {
        	var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
        	formData.append('id', parseInt(id));

            // Send an AJAX request to validate the data
            $.ajax({
                url: '{{ route('admin.getJobsById') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var status = "Closed";

                    if (response.status == 1) {
                    	status = "Open"
                    } else if (response.status == 2) {
                    	status = "Rejected"
                    }

                    const salary = parseFloat(response.salary).toLocaleString(undefined, {
					  style: 'currency',
					  currency: 'PHP', 
					});

                    $('.modal-view-job .content').html(`
                    	<div>Job Title: ${response.job_title}</div>
                    	<div>Company Name: ${response.employer.company_name}</div>
                    	<div>Job Description: <div>${response.job_description}</div></div>
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
						<div>
                            <span>Update Status:</span>
                            <select class="status cm-input" id="status" data-id="${response.id}">
                            </select>
                        </div>
                    `)

                    var closeSelected = "";
					var openSelected = "";
					var rejectedSelected = "";

					if (response.status == 0) {
					    closeSelected = "selected";
					} else if (response.status == 1) {
					    openSelected = "selected";
					} else if (response.status == 2) {
					    rejectedSelected = "selected";
					}

					var html = "";

					html += `<option value="0" ${closeSelected}>Close</option>
					        <option value="1" ${openSelected}>Open</option>
					        <option value="2" ${rejectedSelected}>Rejected</option>`;

                    $('.status').html(html)
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

        var global_status = "";
        var global_id = 0;
        $(document).on('change', '.status', function() {
            global_id = parseInt($(this).data('id'));
            global_status = $(this).val();

			$('#modal-confirm-job').show()
        })

        $(document).on('click', '.btn-update', function() {
        	var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', global_id);
            formData.append('status', global_status);

            $.ajax({
                url: '{{ route('admin.updateJob') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                        $('.modal').hide()

                        Swal.fire({
                          title: 'Job Status Updated',
                          text: 'Success',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonText: 'OK'
                        });

                        setTimeout(function() {
                            window.location.href = '{{url('admin/jobs')}}'
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