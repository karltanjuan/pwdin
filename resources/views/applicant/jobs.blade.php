@extends('applicant.layouts.master')

@section('title', 'Applicant - Job List')
@section('cover_page')
    <li class="breadcrumb-item text-white active">Job List</li>
@endsection

@section('content')
    <h1 class="text-center mb-5 wow fadeInUp title-label" data-wow-delay="0.1s">Available Jobs for Me</h1>
    <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
        <span>Filter by Job Type:</span>
        <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-3">
            <li class="nav-item">
                <div class="form-check form-check-inline">
                    <input class="form-check-input job_type" type="checkbox" id="internship" value="internship">
                    <label class="form-check-label job_type_label" for="internship"><h6 class="mt-n1 mb-0">Internship</h6></label>
                </div>
            </li>
            <li class="nav-item">
                <div class="form-check form-check-inline">
                    <input class="form-check-input job_type" type="checkbox" id="contract" value="contract">
                    <label class="form-check-label job_type_label" for="contract"><h6 class="mt-n1 mb-0">Contract</h6></label>
                </div>
            </li>
            <li class="nav-item">
                <div class="form-check form-check-inline">
                    <input class="form-check-input job_type" type="checkbox" id="part-time" value="part-time">
                    <label class="form-check-label job_type_label" for="part-time"><h6 class="mt-n1 mb-0">Part Time</h6></label>
                </div>
            </li>
            <li class="nav-item">
                <div class="form-check form-check-inline">
                    <input class="form-check-input job_type" type="checkbox" id="full-time" value="full-time">
                    <label class="form-check-label job_type_label" for="full-time"><h6 class="mt-n1 mb-0">Full Time</h6></label>
                </div>
            </li>
        </ul>
        <br>
        <span>Filter by Working Days:</span>
        <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-3">
            <li class="nav-item">
                <div class="form-check form-check-inline">
                    <input class="form-check-input working_days" type="checkbox" id="monday" value="monday">
                    <label class="form-check-label working_days_label" for="monday"><h6 class="mt-n1 mb-0">Monday</h6></label>
                </div>
            </li>
            <li class="nav-item">
                <div class="form-check form-check-inline">
                    <input class="form-check-input working_days" type="checkbox" id="tuesday" value="tuesday">
                    <label class="form-check-label working_days_label" for="tuesday"><h6 class="mt-n1 mb-0">Tuesday</h6></label>
                </div>
            </li>
            <li class="nav-item">
                <div class="form-check form-check-inline">
                    <input class="form-check-input working_days" type="checkbox" id="wednesday" value="wednesday">
                    <label class="form-check-label working_days_label" for="wednesday"><h6 class="mt-n1 mb-0">Wednesday</h6></label>
                </div>
            </li>
            <li class="nav-item">
                <div class="form-check form-check-inline">
                    <input class="form-check-input working_days" type="checkbox" id="thursday" value="thursday">
                    <label class="form-check-label working_days_label" for="thursday"><h6 class="mt-n1 mb-0">Thursday</h6></label>
                </div>
            </li>
            <li class="nav-item">
                <div class="form-check form-check-inline">
                    <input class="form-check-input working_days" type="checkbox" id="friday" value="friday">
                    <label class="form-check-label working_days_label" for="friday"><h6 class="mt-n1 mb-0">Friday</h6></label>
                </div>
            </li>
            <li class="nav-item">
                <div class="form-check form-check-inline">
                    <input class="form-check-input working_days" type="checkbox" id="saturday" value="saturday">
                    <label class="form-check-label working_days_label" for="saturday"><h6 class="mt-n1 mb-0">Saturday</h6></label>
                </div>
            </li>
            <li class="nav-item">
                <div class="form-check form-check-inline">
                    <input class="form-check-input working_days" type="checkbox" id="sunday" value="sunday">
                    <label class="form-check-label working_days_label" for="sunday"><h6 class="mt-n1 mb-0">Sunday</h6></label>
                </div>
            </li>
        </ul>

        <div class="row mb-2">
            <div class="col-md-4">
                <select class="btn-filter form-select" id="btn-filter">  
                    <option disabled selected>View all jobs or view related jobs</option>
                    <option value="related" selected>Related Jobs</option>
                    <option value="all">All Jobs</option>
                </select>
            </div>
            <div class="col-md-4">
                <select class="btn-industry form-select" id="btn-industry">  
                    <option disabled selected>Filter by Job Industry</option>
                    <option value="Accounting/Finance">Accounting/Finance</option>
                    <option value="Admin/Human Resources">Admin/Human Resources</option>
                    <option value="Sales/Marketing">Sales/Marketing</option>
                    <option value="Arts/Media/Communication">Arts/Media/Communication</option>
                    <option value="Services">Services</option>
                    <option value="Hotel/Restaurant">Hotel/Restaurant</option>
                    <option value="Education/Training">Education/Training</option>
                    <option value="Computer/Information Technology">Computer/Information Technology</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Manufacturing">Manufacturing</option>
                    <option value="Building/Construction">Building/Construction</option>
                    <option value="Sciences">Sciences</option>
                    <option value="Healthcare">Healthcare</option>
                    <option value="Journalist/Editors">Journalist/Editors</option>
                    <option value="General Work">General Work</option>
                    <option value="Publishing">Publishing</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="col-md-4">
                <select class="btn-career_level form-select" id="btn-career_level">  
                    <option disabled selected>Filter by Career Level</option>
                    <option value="Intern Level">Intern Level</option>
                    <option value="Entry Level">Entry Level</option>
                    <option value="Associate Level">Associate Level</option>
                    <option value="Mid Level">Mid Level</option>
                    <option value="Senior Level">Senior Level</option>
                    <option value="Director">Director</option>
                </select>
            </div>
        </div>
        
        <div class="row mb-2">
            <div class="col-md-4">
                <select class="btn-pwd-categories form-select" id="btn-pwd-categories">  
                    <option disabled selected>Filter by PWD Category</option>
                    <option value="Psychosocial">Psychosocial</option>
                    <option value="Mental">Mental</option>
                    <option value="Chronic illness">Chronic illness</option>
                    <option value="Learning">Learning</option>
                    <option value="Visual">Visual</option>
                    <option value="Orthopedic">Orthopedic</option>
                    <option value="Communication">Communication</option>
                    <option value="Physical">Physical</option>
                    <option value="Deaf/Hard of Hearing">Deaf/Hard of Hearing</option>
                    <option value="Intellectual">Intellectual</option>
                    <option value="Speech and Language">Speech and Language</option>
                    <option value="Cancer">Cancer</option>
                    <option value="Rare Disease">Rare Disease</option>
                </select>
            </div>

            <div class="col-md-4">
                <select class="btn-qualification form-select" id="btn-qualification">
                    <option disabled selected>Filter by Qualification</option>
                    <option value="Grade School">Grade School</option>
                    <option value="High School">High School</option>
                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                    <option value="Vocational">Vocational</option>
                    <option value="Post-Graduate">Post-Graduate</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <div class="col-md-4">
                <select class="btn-work-setup form-select" id="btn-work-setup">
                    <option disabled selected>Filter by Work Setup</option>
                    <option value="Onsite">Onsite</option>
                    <option value="Remote">Remote</option>
                    <option value="Hybrid">Hybrid</option>
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="d-flex justify-content-center mb-3">
                    <span class="me-3">Filter by Salary Range:</span>
                    <div>
                        <input type="number" class="form-control salary_start" placeholder="0.00"/>
                    </div> <span class="ms-1 me-1 mt-1 text-bold">-</span>
                    <div>
                        <input type="number" class="form-control salary_end" placeholder="100,000.00"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control query" placeholder="Search jobs"/>
                    <button class="btn btn-outline-primary btn-search" type="button" id="btn-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div id="tab-1" class="tab-pane fade show p-0 active"></div>
            <div id="pagination" class="d-flex justify-content-center my-4"></div>
        </div>
    </div>

    @include('applicant.layouts.scripts')
    <script>
        let page           = 1;
        let data_type      = null;
        let industry       = null;
        let career_level   = null;
        let qualification  = null;
        let work_setup     = null;
        let related        = 'related';
        let salary_start   = 0;
        let salary_end     = 0;
        let query          = null;
        let job_types      = [];
        let working_days   = [];
        let pwd_categories = null;

        $(document).ready(function() {
            job_types = $(".job_type").map(function() {
                return $(this).val();
            }).get();

            working_days = $(".working_days").map(function() {
                return $(this).val();
            }).get();

            filterJobs(data_type, industry, salary_start, salary_end, related, query, page = 1, career_level, qualification, work_setup, pwd_categories);
            
        });

        $(document).on('click', '#pagination .page-link', function() {
            page = $(this).data('page');
            filterJobs(data_type, industry, salary_start, salary_end, related, query, page, career_level, qualification, work_setup, pwd_categories);
        });

        $(document).on('click', '.job-types', function() {
            data_type = $(this).data('type');
            filterJobs(data_type, industry, salary_start, salary_end, related, query, page = 1, career_level, qualification, work_setup, pwd_categories);
        })

        $(".job_type").change(function() {
            job_types = $(".job_type:checked").map(function() {
                return $(this).val();
            }).get();

            filterJobs(data_type, industry, salary_start, salary_end, related, query, page, career_level, qualification, work_setup, pwd_categories);
        });

        $(".working_days").change(function() {
            working_days = $(".working_days:checked").map(function() {
                return $(this).val();
            }).get();

            filterJobs(data_type, industry, salary_start, salary_end, related, query, page, career_level, qualification, work_setup, pwd_categories);
        });

        $(document).on('change', '.btn-filter', function() {
            related = $(this).val();
            filterJobs(data_type, industry, salary_start, salary_end, related, query, page = 1, career_level, qualification, work_setup, pwd_categories);
        })

        $(document).on('change', '.btn-industry', function() {
            industry = $(this).val();
            filterJobs(data_type, industry, salary_start, salary_end, related, query, page = 1, career_level, qualification, work_setup, pwd_categories);
        })

        $(document).on('change', '.btn-career_level', function() {
            career_level = $(this).val();
            filterJobs(data_type, industry, salary_start, salary_end, related, query, page = 1, career_level, qualification, work_setup, pwd_categories);
        })

        $(document).on('change', '.btn-qualification', function() {
            qualification = $(this).val();
            filterJobs(data_type, industry, salary_start, salary_end, related, query, page = 1, career_level, qualification, work_setup, pwd_categories);
        })

        $(document).on('change', '.btn-work-setup', function() {
            work_setup = $(this).val();
            filterJobs(data_type, industry, salary_start, salary_end, related, query, page = 1, career_level, qualification, work_setup, pwd_categories);
        })

        $(document).on('change', '.btn-pwd-categories', function() {
            pwd_categories = $(this).val();
            filterJobs(data_type, industry, salary_start, salary_end, related, query, page = 1, career_level, qualification, work_setup, pwd_categories);
        })

        $(document).on('keypress', '.salary_start', function(e) {
            if (e.keyCode === 13) {
                salary_start = $(this).val()
                salary_end = $('.salary_end').val()
                
                filterJobs(data_type, industry, salary_start, salary_end, related, query, page = 1, career_level, qualification, work_setup, pwd_categories);
            }
        })

        $(document).on('keypress', '.salary_end', function(e) {
            if (e.keyCode === 13) {
                salary_start = $('.salary_start').val()
                salary_end = $(this).val()
                filterJobs(data_type, industry, salary_start, salary_end, related, query, page = 1, career_level, qualification, work_setup, pwd_categories);
            }
        })

        $(document).on('keypress', '.query', function(e) {
            if (e.keyCode === 13) {
                query = $(this).val();
                salary_start = $('.salary_start').val()
                salary_end = $('.salary_end').val()

                filterJobs(data_type, industry, salary_start, salary_end, related, query, page = 1, career_level, qualification, work_setup, pwd_categories);
            }
        })

        $(document).on('click', '.btn-search', function() {
            query = $('.query').val();
            salary_start = $('.salary_start').val()
            salary_end = $('.salary_end').val()

            filterJobs(data_type, industry, salary_start, salary_end, related, query, page, career_level, qualification, work_setup, pwd_categories);
        })

        function filterJobs(data_type, industry, salary_start, salary_end, related, query, page = 1, career_level, qualification, work_setup, pwd_categories) {

            if (job_types.length == 0) {
                working_days = $(".job_types").map(function() {
                    return $(this).val();
                }).get();
            }

            if (working_days.length == 0) {
                working_days = $(".working_days").map(function() {
                    return $(this).val();
                }).get();
            }

            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('page', page);
            formData.append('type', data_type);
            formData.append('industry', industry);
            formData.append('related', related)
            formData.append('salary_start', salary_start)
            formData.append('salary_end', salary_end)
            formData.append('search_query', query)
            formData.append('job_types', job_types)
            formData.append('working_days', working_days)
            formData.append('career_level', career_level);
            formData.append('qualification', qualification);
            formData.append('work_setup', work_setup);
            formData.append('pwd_categories', pwd_categories);

            // Send an AJAX request to validate the data
            $.ajax({
                url: '{{ route('applicant.getJobs') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    let html = ''
                    if (response.data.length > 0) {
                        $.each(response.data, function(index, val) {

                            let salary = parseFloat(val.salary).toLocaleString(undefined, {
                                style: 'currency',
                                currency: 'PHP',
                            });

                            if (val.hide_salary === 1){
                                salary = '*'.repeat(salary.toString().length);
                                salary = `<span>&#8369; ${salary}<span>`
                            }

                            let job_status = "Apply Now";
                            if (val.applications.length > 0 && val.applications[0].status !== 'Withdrawn') {
                                job_status = "Withdraw"
                            } 

                            let company_logo = val.employer.company_logo.replace('public', 'storage')
                            html += `<div class="job-item p-4 mb-4">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded"
                                            src="{{url('/')}}/${company_logo}" alt=""
                                            style="width: 80px; height: 80px;">
                                        <div class="text-start ps-4">
                                            <h5 class="mb-0">${val.job_title}</h5>
                                            <p class="mb-3">${val.employer.company_name}<p>
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
                                            <a class="btn btn-primary btn-apply" href="{{url('/applicant/job-details/${val.id}')}}">${job_status}</a>
                                        </div>
                                        <small class="text-truncate">
                                            <i class="far fa-calendar-alt text-primary me-2"></i>
                                            Date Posted ${moment(val.created_at).format('M/D/YYYY')}
                                        </small>
                                    </div>
                                </div>
                            </div>`
                        })

                        getPagination(response)

                    } else {
                        if (data_type === null) {
                            html += `<h4 class="text-center">No jobs available at the moment.</h4>`
                        } else {
                            html += `<h4 class="text-center">No ${data_type} jobs available at the moment.</h4>`
                        }

                        $('#pagination').empty();
                    }

                    $('#tab-1').html(html)
                    
                },
                error: function(xhr, status, error) {
                    console.log(error)
                }
            });
        }

        function getPagination(response) {
            let pagination_html = '<ul class="pagination">';
            
            pagination_html += '<li class="page-item">';
            pagination_html += '<a class="page-link" data-page="1" href="javascript:void(0)">First</a>';
            pagination_html += '</li>';
            
            for (let page = 1; page <= response.last_page; page++) {
                pagination_html += '<li class="page-item ' + (response.current_page === page ? 'active' : '') + '">';
                pagination_html += '<a class="page-link" data-page="' + page + '" href="javascript:void(0)">' + page + '</a>';
                pagination_html += '</li>';
            }

            pagination_html += '<li class="page-item">';
            pagination_html += '<a class="page-link" data-page="' + response.last_page + '" href="javascript:void(0)">Last</a>';
            pagination_html += '</li>';
            pagination_html += '</ul>';

            $('#pagination').html(pagination_html);
        }
    </script>
@endsection
