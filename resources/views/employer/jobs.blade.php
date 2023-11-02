@extends('employer.layouts.master')

@php $page_title = "Job Post"; @endphp

@section('title', 'Employer - ' . $page_title)
@section('cover_page')
    <li class="breadcrumb-item text-white active">{{ $page_title }}</li>
@endsection

@section('content')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />

    <style>
        #jobs-table_filter,
        .pagination {
            float: right !important;
        }

        thead > tr > th {
            width: 300px !important;
        }

        th:hover {
            cursor: pointer;
        }

    </style>

    <h1 class="text-center mb-1 wow fadeInUp title-label" data-wow-delay="0.1s">{{ $page_title }}</h1>
    <button class="mt-4 btn btn-primary btn-add mb-5 position-absolute" style="margin-left:100px;height:48px;">Add Job</button>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered jobs-table wow fadeInUp" id="jobs-table" data-wow-delay="0.1s">
                <thead class="table-dark">
                    <tr>
                        <th>Job Title <i class="fa-solid fa-sort"></i></th>
                        <th>Total Candidates <i class="fa-solid fa-sort"></i></th>
                        <th>Hired <i class="fa-solid fa-sort"></i></th>
                        <th>Rejected <i class="fa-solid fa-sort"></i></th>
                        <th>Job Status <i class="fa-solid fa-sort"></i></th>
                        <th>Posted <i class="fa-solid fa-sort"></i></th>
                        <th>Action <i class="fa-solid fa-sort"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($jobs) > 0)
                        @foreach ($jobs as $job)
                            <tr>
                                <td>{{ $job->job_title }}</td>
                                <td>
                                    @if (count($job->applications) != 0)
                                        <a class="text-center btn btn-sm btn-info text-white" href="{{ url("/employer/jobs/{$job->id}/applicants") }}">
                                            <i class="fa-regular fa-user"></i>
                                            {{ count($job->applications) }} 
                                            Applicant
                                        </a>
                                    @else
                                        <span>0</span>
                                    @endif
                                </td>
                                <td>
                                    {{ count($job->applications->where('status', 'Hired')) }}
                                </td>
                                <td>
                                    {{ count($job->applications->where('status', 'Rejected')) }}
                                </td>
                                <td>
                                    @if ($job->status === 0)
                                        <span class="badge bg-warning">Pending Payment</span>
                                    @elseif($job->status === 1)
                                        <span class="badge bg-success">Active</span>
                                    @elseif($job->status === 2)
                                        <span class="badge bg-secondary">Inactive</span>
                                    @elseif($job->status === 3)
                                        <span class="badge bg-danger">Closed</span>
                                    @endif
                                </td>
                                <td>{{ date('m/d/y', strtotime($job->created_at)) }}</td>
                                <td class="text-center">
                                    <button title="Edit Job" class="btn btn-outline-primary btn-sm btn-edit" id="btn-edit" data-id="{{ $job->id }}">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    <button title="Delete Job" class="btn btn-outline-danger btn-sm btn-delete" id="btn-delete"
                                        data-id="{{ $job->id }}">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                    <button title="View Job" class="btn btn-outline-dark btn-sm btn-view" id="btn-view"
                                        data-id="{{ $job->id }}">
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


    @include('employer.layouts.scripts')

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>

        var datatable_job = $('.jobs-table').DataTable({
            "order": [[1, 'asc']],
        });

        $('#jobs-table_length select').removeClass('form-select-sm').addClass('form-select-lg')
        $("input[type='search']").addClass('form-control form-control-lg mb-3')


    </script>
@endsection
