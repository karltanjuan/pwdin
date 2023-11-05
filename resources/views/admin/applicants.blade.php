@extends('admin.layouts.master')

@php $page_title = "Applicants Monitoring"; @endphp
@section('title', 'Admin - '.$page_title)

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-5">{{$page_title}}</h1>
    
    <div class="row mb-5">
        <div class="col-md-12">
            <table class="table table-bordered table-striped applicants-table" id="applicants-table">
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
                            <tr>
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
                                        <span class="badge bg-secondary">Pending</span>
                                    @elseif($app->status == 1)
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($app->status == 2)
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-outline-secondary btn-view btn-sm" id="btn-view" data-id="{{ $app->id }}">
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
        </div>
    </div>
</div>

<div class="modal fade viewModal" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">View Applicant</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
            
        </div>
      </div>
    </div>
  </div>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        const datatablesSimple = document.getElementById('applicants-table');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });

    let id = 0;
    $(document).on('click', '.btn-view', function() {
        id = $(this).data('id')
        getApplicantById(id)
        $('#viewModal').modal('show')
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

                $('#viewModal .modal-body').html(`
                    <div class="mx-auto text-center mb-3">
                        <p>Profile Photo:</p> <img class="img-fluid rounded" src='{{asset('${profile_photo}')}}' alt='Profile Photo'/>
                    </div>
                    <ul class="list-group">
                    <li class="list-group-item">Full Name: ${applicant.first_name} ${applicant.middle_name} ${applicant.last_name} ${applicant.prefix !== null ? applicant.prefix : ''}</li>
                    <li class="list-group-item">PWD Category: ${applicant.pwd_categories}</li>
                    <li class="list-group-item">PWD Card: <a href='{{asset('${pwd_card}')}}' target='_blank'>View and Download</a></li>
                    <li class="list-group-item">Resume: <a href='{{asset('${resume}')}}' target='_blank'>View and Download</a></li>
                    <li class="list-group-item">Education Level: ${applicant.education_level}</li>
                    <li class="list-group-item">Mobile Number: ${applicant.mobile_no}</li>
                    <li class="list-group-item">Email Address: ${applicant.email}</li>
                    <li class="list-group-item">Gender: ${applicant.gender}</li>
                    <li class="list-group-item">Date Registered: ${moment(applicant.created_at).format('LLL')}</li>
                    <li class="list-group-item">Date Approved: ${moment(applicant.updated_at).format('LLL')}</li>
                    <li class="list-group-item">Birthdate: ${moment(applicant.birthdate).format('LL')}</li>
                    <li class="list-group-item">Full Address: ${applicant.address}, ${applicant.city}, ${applicant.province}, ${applicant.zip_code}</li>
                    </ul>
                    <label class="mt-3" for="status">Update Status:</label>
                    <div class="input-group">
                        <select class="form-select status" id="status" data-id="${applicant.id}"></select>
                        <button type="button" class="btn-update btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Update Application</button>
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

    $(document).on('click', '.btn-update', function() {
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('id', id);
        formData.append('status', $('.status').val());

        $.ajax({
            url: '{{ route('admin.updateApplicantApproval') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.code == "200") {
                    $('#viewModal').modal('hide')

                    toastr.success('Applicant Status Updated', 'Success')

                    setTimeout(function() {
                        window.location.href = '{{url('admin/applicants')}}'
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
</script>
@endsection
