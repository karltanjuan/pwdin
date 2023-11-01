@extends('employer.layouts.master')

@php $page_title = "Job Post"; @endphp

@section('title', 'Employer - ' . $page_title)
@section('cover_page')
    <li class="breadcrumb-item text-white active">{{ $page_title }}</li>
@endsection

@section('content')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />

    <style>

    </style>

    <h1 class="text-center mb-1 wow fadeInUp title-label" data-wow-delay="0.1s">{{ $page_title }}</h1>
    <p class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s"><b>Note</b>: lorem</p>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered jobs-table" id="jobs-table">
                <thead class="table-secondary">
                    <tr>
                        <th>Job Title</th>
                        <th>Total Candidates</th>
                        <th>Hired</th>
                        <th>Rejected</th>
                        <th>Job Status</th>
                        <th>Posted</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Web Developer</td>
                        <td>
                            <a href="#">123</a>
                        </td>
                        <td>5</td>
                        <td>1</td>
                        <td>Active</td>
                        <td>{{ date('m/d/Y', strtotime('2023-10-31')) }}</td>
                        <td>
                            <button title="Edit Job" class="btn btn-outline-primary btn-edit" id="btn-edit" data-id="1">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button title="Delete Job" class="btn btn-outline-danger btn-delete" id="btn-delete"
                                data-id="1">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                            <button title="View Job" class="btn btn-outline-secondary btn-view" id="btn-view"
                                data-id="1">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Web Developer</td>
                        <td>
                            <a href="#">123</a>
                        </td>
                        <td>5</td>
                        <td>1</td>
                        <td>Active</td>
                        <td>{{ date('m/d/Y', strtotime('2023-10-31')) }}</td>
                        <td>
                            <button title="Edit Job" class="btn btn-outline-primary btn-edit" id="btn-edit" data-id="1">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button title="Delete Job" class="btn btn-outline-danger btn-delete" id="btn-delete"
                                data-id="1">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                            <button title="View Job" class="btn btn-outline-secondary btn-view" id="btn-view"
                                data-id="1">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Web Developer</td>
                        <td>
                            <a href="#">123</a>
                        </td>
                        <td>5</td>
                        <td>1</td>
                        <td>Active</td>
                        <td>{{ date('m/d/Y', strtotime('2023-10-31')) }}</td>
                        <td>
                            <button title="Edit Job" class="btn btn-outline-primary btn-edit" id="btn-edit" data-id="1">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button title="Delete Job" class="btn btn-outline-danger btn-delete" id="btn-delete"
                                data-id="1">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                            <button title="View Job" class="btn btn-outline-secondary btn-view" id="btn-view"
                                data-id="1">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </td>
                    </tr>
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
            // "lengthChange": false,
            // "iDisplayLength": 2,
            // "order": [[0, 'asc']],
        });

        $("input[type='search']").addClass('form-control form-control-lg mb-3')

        // new DataTable('.jobs-table');
    </script>
@endsection
