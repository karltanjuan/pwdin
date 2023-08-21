@extends('admin.layouts.master')

@section('title', 'Admin - Applicant Approval')

@section('content')
    <style>
        .modal-view-applicant .content > div {
            border: 1px solid #333;
            padding: 5px;
        }

        .modal-view-applicant .content > div:last-child > div {
            padding-left: 30px;
        }

        .pending-badge,
        .approved-badge,
        .rejected-badge {
        	width: 100px;
        	height: 100px;
        	padding: 10px;
        	border-radius: 50px;
        	font-size: 11px;
        }

        .pending-badge {background: #757575;color: #fff;}
        .approved-badge {background: #2e7d32;color: #fff;}
        .rejected-badge {background: #c62828;color: #fff;}
    </style>

    <div class="head-container">
        <h1>Applicant Approval</h1>
    </div>  

    <table class="applicants-table">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Education Level</th>
                <th>Mobile Number</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Registered</th>
                <th>Approved</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($applicants) > 0)
                @foreach ($applicants as $app)
                <tr class="odd_col">
                    <td>
                        {{ $app->first_name }}
                        {{ $app->middle_name }}
                        {{ $app->last_name }}
                    </td>
                    <td>{{ $app->education_level }}</td>
                    <td>{{ $app->mobile_no }}</td>
                    <td>{{ $app->gender }}</td>
                    <td>{{ $app->city }} {{ $app->province }}</td>
                    <td>{{ date('m/d/y', strtotime($app->created_at))}}</td>
                    <td>{{ date('m/d/y', strtotime($app->updated_at))}}</td>
                    <td>
                    	@if($app->status == 0)
                    		<span class="pending-badge">Pending</span>
                    	@elseif($app->status == 1)
                    		<span class="approved-badge">Approved</span>
                    	@elseif($app->status == 2)
                    		<span class="rejected-badge">Rejected</span>
                    	@endif
                    </td>
                    <td>
                        <button class="btn-view" id="btn-view" data-id="{{ $app->id }}">
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
                    <td></td>
                </tr>
            @endif
    </tbody>
    </table>
    
    <!-- modal -->
    <div id="modal-view-applicant" class="modal modal-view-applicant">
        <div class="modal-content">
            <div class="modal-header">
                <h2>View Applicant</h2>
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

    <div id="modal-confirm-applicant" class="modal modal-confirm-applicant">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Update Applicant</h2>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script>
        var id = 0;
        $(document).ready(function() {
        })

        function getApplicantById(id) {
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', parseInt(id));

            // Send an AJAX request to validate the data
            $.ajax({
                url: '{{ route('admin.getApplicantById') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var applicant   = response

                    var pwd_card = applicant.pwd_card.replace('public', 'storage')
                    var resume = applicant.resume.replace('public', 'storage')
                    var profile_photo = applicant.profile_photo.replace('public', 'storage')

                    $('.modal-view-applicant .content').html(`
                        <div>Full Name: ${applicant.first_name} ${applicant.middle_name} ${applicant.last_name} ${applicant.prefix !== null ? applicant.prefix : ''}</div>
                        <div>PWD Category: ${applicant.pwd_categories}</div>
                        <div>PWD Card: <a href='{{asset('${pwd_card}')}}' target='_blank'>View and Download</a></div>
                        <div>Resume: <a href='{{asset('${resume}')}}' target='_blank'>View and Download</a></div>

                        <div><p>Profile Photo:</p> <img class="img-fluid" src='{{asset('${profile_photo}')}}' alt='Profile Photo'/></div>

                        <div>Education Level: ${applicant.education_level}</div>
                        <div>Mobile Number: ${applicant.mobile_no}</div>
                        <div>Email Address: ${applicant.email}</div>
                        <div>Gender: ${applicant.gender}</div>
                        <div>Date Registered: ${moment(applicant.created_at).format('LLL')}</div>
                        <div>Date Approved: ${moment(applicant.updated_at).format('LLL')}</div>
                        <div>Birthdate: ${moment(applicant.birthdate).format('LL')}</div>
                        <div>Full Address: ${applicant.address}, ${applicant.city}, ${applicant.province}, ${applicant.zip_code}</div>
                        <div>
                            <span>Update Status:</span>
                            <select class="status cm-input" id="status" data-id="${applicant.id}">
                            </select>
                        </div>
                    `)

					var pendingSelected = "";
					var approvedSelected = "";
					var rejectedSelected = "";

					if (applicant.status == 0) {
					    pendingSelected = "selected";
					} else if (applicant.status == 1) {
					    approvedSelected = "selected";
					} else if (applicant.status == 2) {
					    rejectedSelected = "selected";
					}

					var html = "";

					html += `<option value="0" ${pendingSelected}>Pending</option>
					        <option value="1" ${approvedSelected}>Approved</option>
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
            getApplicantById(id)
            $('.modal-view-applicant').show();
        })

        function closeModal() {
            $(".modal").css("display", "none");
        }

        $(document).on('click', '.modal-close, .btn-cancel', function() {
            closeModal()
        })

        var datatable_job = $('.applicants-table').DataTable({
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

			$('#modal-confirm-applicant').show()
        })

        $(document).on('click', '.btn-update', function() {
        	var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', global_id);
            formData.append('status', global_status);

            $.ajax({
                url: '{{ route('admin.updateApplicantApproval') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                        $('.modal').hide()

                        Swal.fire({
                          title: 'Applicant Status Updated',
                          text: 'Success',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonText: 'OK'
                        });

                        setTimeout(function() {
                            window.location.href = '{{url('admin/applicants')}}'
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