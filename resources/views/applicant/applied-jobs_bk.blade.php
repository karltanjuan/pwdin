@extends('applicant.layouts.master')

@section('title', 'Applicant - Applied Jobs')

@section('content')
	<style>
		.modal-view-job .content > div {
			border: 1px solid #333;
			padding: 5px;
		}

		.modal-view-job .content > div:last-child > div {
			padding-left: 30px;
		}

        .job-container {
            display: flex;
            flex-wrap: wrap;
        }

        .job-card {
            border-radius: 5px;
            background: rgb(229, 228, 228);
            /* display: block; */
            margin-bottom: 10px;
            margin-right: 10px;
            padding: 10px;
            width: 100%;
        }

        .btn-withdraw {
            display: inline-block;
            float: right;
        }

        .company_logo {
            width: 150px;
            height: auto;
            float: right;
            margin-top: -55px;
            border-radius: 5px;
        }

        .progress-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 20px;
            background: #cacaca;
            border-left: 5px dashed #333;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        /* Style for each progress step */
        .progress-step {
            flex: 1;
            text-align: center;
            position: relative;
            position: relative;
            width: 200px; /* Adjust the width as needed */
            padding: 3px;
            border: 2px solid #333;
            border-right: none;
        }

        .progress-step::before {
            content: '';
            position: absolute;
            top: 50%;
            right: -12px;
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-left: 10px solid #333;
            transform: translateY(-50%);
        }

        .progress-step:last-child::before {
            content: none;
        }

        .step-label {
            font-size: 11px;
        }

        .step-indicator {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #ccc;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            background-color: #007bff;
            color: white;
        }

        .current-status {
            background: #333;
            color: #fff;
        }

        .current-status > .step-indicator {
            background: green;
        }

        .bg-withdrawn {
            background: rgb(220, 134, 22);
            color: #fff;
            padding: 5px;
            border-radius: 10px;
        }

        .rejected {
            background: red;

        }
	</style>

    <div class="head-container">
    	<h1>Applied Jobs</h1>
    </div>

    @if (count($jobs) > 0)
        <div class="job-container">
            @foreach ($jobs as $job)
                <div class="job-card">
                    <h3 class="job-title">{{ $job->job_title }}</h3>
                    <p class="company"><i>{{ $job->employer->company_name }}</i></p>
                    @php  $company_logo = str_replace('public', 'storage', $job->employer->company_logo) @endphp
                    <img class="company_logo" src="{{asset($company_logo)}}" alt="Company Logo"/>
                    <h5 class="date-applied">
                        <span>Date Applied: {{ date('m/d/y H:i A', strtotime($job->applications[0]->created_at))}}</span>
                    </h5>
                    <div class="job-status">
                        <p>Job Status: <span>{{ $job->status == 1 ? 'Open' : 'Close' }}</span></p>
                    </div>

                    @php 
                        $app_status = $job->applications[0]->status
                    @endphp

                    <div class="application-status">
                        <p>
                            <span>Application Status: </span>
                            {{-- <span class="{{ $app_status == "Withdrawn" ? 'bg-withdrawn' : '' }}">
                                {{ count($job->applications) > 0 ? $app_status : '-' }}
                            </span> --}}
                        </p>
                        @php
                            $statuses = json_decode($job->employer->application_statuses->name); 
                            $key_counter = 1;
                        @endphp

                        @php
                            $rejected = '';
                            if ($job->applications[0]->is_rejected === 1) {
                                $rejected = 'rejected';

                            }
                        @endphp

                        
                        <div class="progress-bar">
                            @if ($app_status == "Applied")
                                <div class="progress-step current-status">
                                    <div class="step-indicator">{{ $key_counter++ }}</div>
                                    <div class="step-label">Applied</div>
                                </div>
                            @else
                                <div class="progress-step">
                                    <div class="step-indicator">{{ $key_counter++ }}</div>
                                    <div class="step-label">Applied</div>
                                </div>
                            @endif

                            @foreach($statuses as $status)
                                <div class="progress-step {{ $app_status == $status ? 'current-status' : '' }} {{ $app_status == $status && $job->applications[0]->is_rejected === 1 ? 'rejected' : '' }}">
                                    <div class="step-indicator">{{ $key_counter++ }}</div>
                                    <div class="step-label">{{ $status }}</div>
                                </div>
                            @endforeach

                            @if ($app_status == "Withdrawn")
                                <div class="progress-step current-status">
                                    <div class="step-indicator">{{ $key_counter++ }}</div>
                                    <div class="step-label">Withdrawn</div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    @if($job->applications[0]->is_rejected === 1)
                        <p>Rejected Reason: <b>{{ $job->applications[0]->rejected_reason }}</b></p>
                    @endif
                    {{-- add dropdown arrow to view more details --}}
                    @if ($app_status != "Withdrawn")
                        <button class="primary-btn btn-withdraw" data-id="{{$job->applications[0]->job_id}}">Withdraw</button>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center">
            <h3>You haven't applied to any jobs yet.</h3>
            <a href="{{url('applicant/jobs')}}">Click here</a>
            <span> to browse and apply for new opportunities.</span>
        </div>
    @endif
	
	
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
		})

		function closeModal() {
            $(".modal").css("display", "none");
        }

        $(document).on('click', '.modal-close, .btn-cancel', function() {
            closeModal()
        })

		$(document).on('click', '.btn-withdraw', function() {
			var formData = new FormData();
            id = parseInt($(this).data('id'))

            formData.append('_token', "{{ csrf_token() }}");
        	formData.append('job_id', id);

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
                            window.location.href = '{{url('/applicant/applied-jobs')}}'
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
	</script>
@endsection