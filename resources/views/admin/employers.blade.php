@extends('admin.layouts.master')

@section('title', 'Admin - Employer Approval')

@section('content')
    <style>
        .modal-view-employer .content > div {
            border: 1px solid #333;
            padding: 5px;
        }

        .modal-view-employer .content > div:last-child > div {
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
        <h1>Employer Approval</h1>
    </div>  

    <table class="employers-table">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Contact Person</th>
                <th>Mobile Number</th>
                <th>Address</th>
                <th>Registered</th>
                <th>Approved</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($employers) > 0)
                @foreach ($employers as $employer)
                <tr>
                    <td>{{ $employer->company_name }}</td>
                    <td>{{ $employer->contact_person }}</td>
                    <td>{{ $employer->mobile_no }}</td>
                    <td>{{ $employer->city }} {{ $employer->province }}</td>
                    <td>{{ date('m/d/y', strtotime($employer->created_at))}}</td>
                    <td>{{ date('m/d/y', strtotime($employer->updated_at))}}</td>
                    <td>
                    	@if($employer->status == 0)
                    		<span class="pending-badge">Pending</span>
                    	@elseif($employer->status == 1)
                    		<span class="approved-badge">Approved</span>
                    	@elseif($employer->status == 2)
                    		<span class="rejected-badge">Rejected</span>
                    	@endif
                    </td>
                    <td>
                        <button class="btn-view" id="btn-view" data-id="{{ $employer->id }}">
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
    <div id="modal-view-employer" class="modal modal-view-employer">
        <div class="modal-content">
            <div class="modal-header">
                <h2>View Employer</h2>
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

    <div id="modal-confirm-employer" class="modal modal-confirm-employer">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Update Employer</h2>
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

        function getEmployerById(id) {
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', parseInt(id));

            // Send an AJAX request to validate the data
            $.ajax({
                url: '{{ route('admin.getEmployerById') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var employer   = response

                    var company_logo = employer.company_logo.replace('public', 'storage')
                    var business_permit = employer.business_permit.replace('public', 'storage')
                    var bir_certificate = employer.bir_certificate.replace('public', 'storage')

                    $('.modal-view-employer .content').html(`
                        <div>Company Name: ${employer.company_name}</div>
                        <div>Contact Person: ${employer.contact_person}</div>
                        <div><p>Company Logo:</p> <img style="border: 1px solid #333;border-radius:50%;" class="img-fluid" src='{{asset('${company_logo}')}}' alt='Company Logo'/></div>
                        <div>Summary: ${employer.summary}</div>
                        <div>Business Permit: <a href='{{asset('${business_permit}')}}' target='_blank'>View and Download</a></div>
                        <div>BIR Certificate: <a href='{{asset('${bir_certificate}')}}' target='_blank'>View and Download</a></div>

                        <div>Mobile Number: ${employer.mobile_no}</div>
                        <div>Email Address: ${employer.email}</div>
                        <div>Date Registered: ${moment(employer.created_at).format('LLL')}</div>
                        <div>Date Approved: ${moment(employer.updated_at).format('LLL')}</div>
                        <div>Full Address: ${employer.address}, ${employer.city}, ${employer.province}, ${employer.zip_code}</div>
                        <div>
                            <span>Update Status:</span>
                            <select class="status cm-input" id="status" data-id="${employer.id}">
                            </select>
                        </div>
                    `)

					var pendingSelected = "";
					var approvedSelected = "";
					var rejectedSelected = "";

					if (employer.status == 0) {
					    pendingSelected = "selected";
					} else if (employer.status == 1) {
					    approvedSelected = "selected";
					} else if (employer.status == 2) {
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
            getEmployerById(id)
            $('.modal-view-employer').show();
        })

        function closeModal() {
            $(".modal").css("display", "none");
        }

        $(document).on('click', '.modal-close, .btn-cancel', function() {
            closeModal()
        })

        var datatable_job = $('.employers-table').DataTable({
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

			$('#modal-confirm-employer').show()
        })

        $(document).on('click', '.btn-update', function() {
        	var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', global_id);
            formData.append('status', global_status);

            $.ajax({
                url: '{{ route('admin.updateEmployerApproval') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                        $('.modal').hide()

                        Swal.fire({
                          title: 'Employer Status Updated',
                          text: 'Success',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonText: 'OK'
                        });

                        setTimeout(function() {
                            window.location.href = '{{url('admin/employers')}}'
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