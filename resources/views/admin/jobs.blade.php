@extends('admin.layouts.master')

@php $page_title = "Jobs Monitoring"; @endphp
@section('title', 'Admin - '.$page_title)

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-5">{{$page_title}}</h1>
    
    <div class="row mb-5">
        <div class="col-md-12">
            <table class="table table-bordered table-striped jobs-table" id="jobs-table">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Company Name</th>
                        <th>Job Status</th>
                        <th>Date Posted</th>
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
                            <td>
                                @if($job->status == 0)
                                    <span class="badge bg-secondary">Close</span>
                                @elseif($job->status == 1)
                                    <span class="badge bg-success">Open</span>
                                @elseif($job->status == 2)
                                    <span class="badge bg-danger">Rejected</span>
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
                                <button class="btn btn-outline-secondary btn-view btn-sm" id="btn-view" data-id="{{ $job->id }}">
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
        </div>
    </div>
</div>

<div class="modal fade viewModal" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">View Job</h5>
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
        const datatablesSimple = document.getElementById('jobs-table');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });

    let id = 0;
    $(document).on('click', '.btn-view', function() {
        id = $(this).data('id')
        getJobsById(id)
        $('#viewModal').modal('show')
    })

    function getJobsById(id) {
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('id', parseInt(id));

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

                $('#viewModal .modal-body').html(`
                    <ul class="list-group">
                        <li class="list-group-item">Job Title: ${response.job_title}</li>
                        <li class="list-group-item">Company Name: ${response.employer.company_name}</li>
                        <li class="list-group-item">Job Description: <div>${response.job_description}</div></li>
                        <li class="list-group-item">Career Level: ${response.career_level}</li>
                        <li class="list-group-item">Job Type: ${response.job_type}</li>
                        <li class="list-group-item">Industry: ${response.job_industry}</li>
                        <li class="list-group-item">Years of Experience: ${response.years_experience}</li>
                        <li class="list-group-item">Average Processing Days: ${response.average_processing_time}</li>
                        <li class="list-group-item">Salary: ${salary}</li>
                        <li class="list-group-item">Educational Attainment: ${response.qualification}</li>
                        <li class="list-group-item">Work Setup: ${response.work_setup}</div>
                        <li class="list-group-item">Working Days: ${response.working_days}</div>
                        <li class="list-group-item">Allowed Disability: ${response.pwd_categories}</li>
                        <li class="list-group-item">Status: ${status}</div>
                    </ul>

                    <label class="mt-3" for="status">Update Status:</label>
                    <div class="input-group">
                        <select class="form-select status" id="status" data-id="${response.id}"></select>
                        <button type="button" class="btn-update btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Update</button>
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
    
    let click_counter = 0;
    $(document).on('click', '.btn-update', function() {
        $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`);

        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('id', id);
        formData.append('status', $('.status').val());

        if (click_counter === 0) {
                click_counter++;
                $(this).prop('disabled', true);

            $.ajax({
                url: '{{ route('admin.updateJob') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                        $('.btn-update').html(`Update`);
                        $('#viewModal').modal('hide')
                        toastr.success('Job Status Updated', 'Success')

                        setTimeout(function() {
                            window.location.href = '{{url('admin/jobs')}}'
                        }, 2000)
                    } else {
                        displayErrors(JSON.parse(response.errors));
                        $('.btn-update').html(`Update`).prop('disabled', false);
                        click_counter = 0;
                    }
                },
                error: function(xhr, status, error) {
                    var result = JSON.parse(xhr.responseText)
                    displayErrors(result.errors)
                    $('.btn-update').html(`Update`).prop('disabled', false);
                    click_counter = 0;
                }
            });
        }
    })
</script>
@endsection
