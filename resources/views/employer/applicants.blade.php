@extends('employer.layouts.master')

@php $page_title = "Applicants"; @endphp

@section('title', 'Employer - ' . $page_title)
@section('cover_page')
    <li class="breadcrumb-item text-white">
        <a href="{{url('employer/jobs')}}">Job Post</a>
    </li>
    <li class="breadcrumb-item text-white active">{{ $page_title }}</li>
@endsection

@section('content')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />

    <style>
        #jobs-table_filter,
        .pagination {
            float: right !important;
        }

        thead>tr>th {
            width: 300px !important;
        }

        th:hover {
            cursor: pointer;
        }
    </style>

    <h1 class="text-center mb-5 wow fadeInUp title-label" data-wow-delay="0.1s">{{ $page_title }}</h1>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered jobs-table wow fadeInUp" id="jobs-table" data-wow-delay="0.1s">
                <thead class="table-dark">
                    <tr>
                        <th>Job Role Applied</th>
                        <th>Full Name <i class="fa-solid fa-sort"></i></th>
                        <th>Education Level <i class="fa-solid fa-sort"></i></th>
                        <th>Mobile Number <i class="fa-solid fa-sort"></i></th>
                        <th>Gender <i class="fa-solid fa-sort"></i></th>
                        <th>Address <i class="fa-solid fa-sort"></i></th>
                        <th>Date Applied <i class="fa-solid fa-sort"></i></th>
                        <th>Status <i class="fa-solid fa-sort"></i></th>
                        <th>Action <i class="fa-solid fa-sort"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($applicants) > 0)
                        @foreach ($applicants as $app)
                            <tr>
                                <td>{{ $app->job->job_title }}</td>
                                <td>
                                    {{ $app->applicant->first_name }}
                                    {{ $app->applicant->middle_name }}
                                    {{ $app->applicant->last_name }}
                                </td>
                                <td>{{ $app->applicant->education_level }}</td>
                                <td>{{ $app->applicant->mobile_no }}</td>
                                <td>{{ $app->applicant->gender }}</td>
                                <td>{{ $app->applicant->city }} {{ $app->applicant->province }}</td>
                                <td>{{ date('m/d/y', strtotime($app->created_at))}}</td>
                                <td>
                                    @if($app->is_rejected === 1) 
                                        <span class="badge bg-danger">Rejected</span>
                                    @else 
                                        <span class="badge bg-info">{{ $app->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('employer/jobs/' .$app->job_id. '/applicants/' . $app->applicant->id) }}" title="View Applicant Details" class="btn btn-outline-dark btn-sm btn-view" id="btn-view">
                                        <i class="far fa-eye"></i>
                                    </a>
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
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade modal-delete-job" id="modal-delete-job" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-remove">Confirm</button>
                </div>
            </div>
        </div>
    </div>


    @include('employer.layouts.scripts')

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var datatable_job = $('.jobs-table').DataTable({
            "order": [
                [1, 'asc']
            ],
        });

        $('#jobs-table_length select').removeClass('form-select-sm').addClass('form-select-lg')
        $("input[type='search']").addClass('form-control form-control-lg mb-3')

        let id = 0;
        $(document).on('click', '.btn-delete', function() {
            id = $(this).data('id')
        })

        $(document).on('click', '.btn-remove', function() {
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', parseInt(id));

            $.ajax({
                url: '{{ route('employer.deleteJob') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                        $('.modal').modal('hide')
                        toastr.success('Job Post Deleted', 'Success')

                        setTimeout(function() {
                            window.location.href = '{{ url('/employer/jobs') }}'
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
