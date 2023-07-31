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
    	<h1>Job List</h1>
    </div>	

	<table class="jobs-table">
		<thead>
			<tr>
				<th>Job Title</th>
				<th>Job Status</th>
				<th>Created</th>
				<th>Closed</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@if (count($jobs) > 0)
				@foreach ($jobs as $job)
				<tr>
					<td>{{ $job->job_title }}</td>
					<td>{{ $job->status == 1 ? 'Open' : 'Close' }}</td>
					<td>{{ date('m/d/y', strtotime($job->created_at))}}</td>
					<td>N/A</td>
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
	</script>
@endsection