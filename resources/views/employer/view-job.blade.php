@extends('employer.layouts.master')

@section('title', 'Employer - Job Details')
@section('cover_page')
    <li class="breadcrumb-item text-white">
        <a href="{{ url('/employer/jobs') }}">Jobs</a>
    </li>
    <li class="breadcrumb-item text-white active">Job Details</li>
@endsection
@section('content')
    @if(optional($job->employer)->company == null)
        @php
            redirect(url('/employer/jobs'));
        @endphp
    @endif
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gy-5 gx-4">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center mb-5">
                        @php  $company_logo = str_replace('public', 'storage', $job->employer->company_logo) @endphp
                        <img class="flex-shrink-0 img-fluid border rounded" src="{{ asset($company_logo) }}" alt=""
                            style="width: 80px; height: 80px;">
                        <div class="text-start ps-4">
                            <h3 class="mb-3">{{ $job->job_title }}</h3>
                            <span class="text-truncate me-3">
                                <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                {{ $job->employer->address }}, {{ $job->employer->city }}, {{ $job->employer->province }},
                                {{ $job->employer->zip_code }}
                            </span>
                            <span class="text-truncate me-3"><i
                                    class="far fa-clock text-primary me-2"></i>{{ $job->job_type }}</span>
                            <span class="text-truncate me-0">
                                <i class="far fa-money-bill-alt text-primary me-2"></i>&#8369;
                                {{ number_format($job->salary, 2) }}
                                @if ($job->hide_salary === 1)
                                    <span>(Salary Hidden)</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h4 class="mb-3">Job description</h4>
                        <div class="job-desription">
                            {!! $job->job_description !!}
                        </div>
                        <h4 class="mb-3">Other Details</h4>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Status:
                                <i>{{ $job->status == 1 ? 'Active' : 'Inactive' }}</i>
                            </li>
                            <li><i class="fa fa-angle-right text-primary me-2"></i>PWD Categories:
                                <i>{{ $job->pwd_categories }}</i>
                            </li>
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Working Days:
                                <i>{{ $job->working_days }}</i>
                            </li>
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Career Level:
                                <i>{{ $job->career_level }}</i>
                            </li>
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Average Processing Time:
                                <i>{{ $job->average_processing_time }}</i>
                            </li>
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Years of Experience:
                                <i>{{ $job->years_experience }}</i>
                            </li>
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Job Industry:
                                <i>{{ $job->job_industry }}</i>
                            </li>
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Qualification:
                                <i>{{ $job->qualification }}</i>
                            </li>
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Work Setup:
                                <i>{{ $job->work_setup }}</i>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                        <h4 class="mb-4">Job Summary</h4>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Published On:
                            {{ date('m/d/Y', strtotime($job->created_at)) }}</p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Vacancy:
                            {{ $job->status === 1 ? 'Open' : 'Closed' }}</p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Job Nature: {{ $job->job_type }}</p>
                        <p>
                            <i class="fa fa-angle-right text-primary me-2"></i>Salary:
                            &#8369;{{ number_format($job->salary, 2) }}
                            @if ($job->hide_salary === 1)
                                <span>(Salary Hidden)</span>
                            @endif
                        </p>
                        <p>
                            <i class="fa fa-angle-right text-primary me-2"></i>
                            {{ $job->employer->address }}, {{ $job->employer->city }}, {{ $job->employer->province }},
                            {{ $job->employer->zip_code }}
                        </p>
                    </div>
                    <div class="bg-light rounded p-5 wow slideInUp" data-wow-delay="0.1s">
                        <h4 class="mb-4">Company Detail</h4>
                        <p class="m-0 text-justify">{{ $job->employer->summary }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {})
    </script>
@endsection
