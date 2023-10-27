@extends('applicant.layouts.master')

@section('title', 'Applicant - Job List')

@section('content')
    <h1 class="text-center mb-5 wow fadeInUp title-label" data-wow-delay="0.1s">Available Jobs for Me</h1>
    <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
        <span>Filter by Job Type:</span>
        <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-3">
            <li class="nav-item">
                <a class="job-types d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill"
                    href="#tab-1" data-type="internship">
                    <h6 class="mt-n1 mb-0">Internship</h6>
                </a>
            </li>
            <li class="nav-item">
                <a class="job-types d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill"
                    href="#tab-2" data-type="contract">
                    <h6 class="mt-n1 mb-0">Contract</h6>
                </a>
            </li>
            <li class="nav-item">
                <a class="job-types d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill"
                    href="#tab-3" data-type="part-time">
                    <h6 class="mt-n1 mb-0">Part Time</h6>
                </a>
            </li>
            <li class="nav-item">
                <a class="job-types d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-4"
                    data-type="full-time">
                    <h6 class="mt-n1 mb-0">Full Time</h6>
                </a>
            </li>
        </ul>

        <div class="row">
            <div class="col-md-4">
                <select class="btn-filter form-select" id="btn-filter">  
                    <option disabled selected>View all jobs or view related jobs</option>
                    <option value="related">Related Jobs</option>
                    <option value="all">All Jobs</option>
                </select>
            </div>
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <input type="text" class="form-control query" placeholder="Search jobs"/>
                    <button class="btn btn-outline-primary btn-search" type="button" id="btn-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div id="tab-1" class="tab-pane fade show p-0 active">
                @if (count($jobs) > 0)
                    @foreach ($jobs as $job)
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    @php  
                                        $company_logo = str_replace('public', 'storage', $job->employer->company_logo) ;
                                    @endphp
                                    <img class="flex-shrink-0 img-fluid border rounded" src="{{ asset($company_logo) }}" alt="" style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-0">{{ $job->job_title }}</h5>
                                        <p>{{ $job->employer->company_name }}</p>
                                        <span class="text-truncate me-3">
                                            <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                            {{ $job->employer->address }},
                                            {{ $job->employer->province }},
                                            {{ $job->employer->city }}
                                        </span>
                                        <span class="text-truncate me-3">
                                            <i class="far fa-clock text-primary me-2"></i>
                                            {{ $job->job_type }}
                                        </span>
                                        <span class="text-truncate me-0">
                                            <i class="far fa-money-bill-alt text-primary me-2"></i>
                                            
                                            @if($job->hide_salary === 1)
                                                &#8369;{{ str_repeat("*", strlen(number_format($job->salary, 2, '.', ''))) }}
                                            @else
                                                &#8369;{{ number_format($job->salary, 2, '.', ',') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        {{-- <a class="btn btn-light btn-square me-3" href=""><i
                                                class="far fa-heart text-primary"></i></a> --}}
                                        <a class="btn btn-primary" href="">Apply Now</a>
                                    </div>
                                    <small class="text-truncate">
                                        <i class="far fa-calendar-alt text-primary me-2"></i>
                                        Date Posted: {{ date('m/d/Y', strtotime($job->created_at)) }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <a class="btn btn-primary py-3 px-5" href="">Browse More Jobs</a>
                @else
                    <h4 class="text-center">No jobs available at the moment.</h4>
                @endif
            </div>
        </div>
    </div>
    <script>
        let data_type = null;
        let related   = 'related';
        let query     = null;

        $(document).on('click', '.job-types', function() {
            data_type = $(this).data('type');
            filterJobs(data_type, related, query);
        })

        $(document).on('change', '.btn-filter', function() {
            related = $(this).val();
            filterJobs(data_type, related, query);
        })

        $(document).on('keypress', '.query', function(e) {
            if (e.keyCode === 13) {
                query = $(this).val();
                filterJobs(data_type, related, query);
            }
        })


        $(document).on('click', '.btn-search', function() {
            query = $('.query').val();
            filterJobs(data_type, related, query);
        })

        function filterJobs(data_type, related, query) {
            var formData = new FormData();

            formData.append('_token', "{{ csrf_token() }}");
            formData.append('type', data_type);
            formData.append('related', related)
            formData.append('search_query', query)

            // Send an AJAX request to validate the data
            $.ajax({
                url: '{{ route('applicant.getJobs') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    let html = ''
                    if (response.length > 0) {
                        $.each(response, function(index, val) {

                            let salary = parseFloat(val.salary).toLocaleString(undefined, {
                                style: 'currency',
                                currency: 'PHP',
                            });

                            if (val.hide_salary === 1){
                                salary = '*'.repeat(salary.toString().length);
                                salary = `<span>&#8369; ${salary}<span>`
                            }

                            html += `<div class="job-item p-4 mb-4">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded"
                                            src="{{ asset('/img/com-logo-1.jpg') }}" alt=""
                                            style="width: 80px; height: 80px;">
                                        <div class="text-start ps-4">
                                            <h5 class="mb-3">${val.job_title}</h5>
                                            <span class="text-truncate me-3">
                                                <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                                ${val.employer.address},
                                                ${val.employer.province},
                                                ${val.employer.city}
                                            </span>
                                            <span class="text-truncate me-3">
                                                <i class="far fa-clock text-primary me-2"></i>
                                                ${val.job_type}
                                            </span>
                                            <span class="text-truncate me-0">
                                                <i class="far fa-money-bill-alt text-primary me-2"></i>
                                                ${salary}
                                            </span>
                                        </div>
                                    </div>
                                    <div
                                        class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                            <a class="btn btn-primary" href="">Apply Now</a>
                                        </div>
                                        <small class="text-truncate">
                                            <i class="far fa-calendar-alt text-primary me-2"></i>
                                            Date Posted ${moment(val.created_at).format('M/D/YYYY')}
                                        </small>
                                    </div>
                                </div>
                            </div>`
                        })
                    } else {
                        html += `<h4 class="text-center">No ${data_type} jobs available at the moment.</h4>`
                    }

                    $('#tab-1').html(html)
                },
                error: function(xhr, status, error) {
                    console.log(error)
                }
            });
        }
    </script>
@endsection
