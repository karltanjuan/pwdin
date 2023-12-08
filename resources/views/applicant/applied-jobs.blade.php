@extends('applicant.layouts.master')

@section('title', 'Applicant - Applied Jobs')
@section('cover_page')
    <li class="breadcrumb-item text-white active">Applied Jobs</li>
@endsection

@section('content')
    <h1 class="text-center mb-5 wow fadeInUp title-label" data-wow-delay="0.1s">Applied Jobs</h1>
    <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text">Start Date Applied</span>
                    <input type="date" class="form-control start_date" id="start_date"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text">End Date Applied</span>
                    <input type="date" class="form-control end_date" id="end_date"/>
                    <button class="btn btn-outline-secondary btn-clear" type="button" id="btn-clear">
                        <span>Clear</span>
                    </button>
                </div>
            </div>
            <div class="col-md-4">
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
        let page       = 1;
        let query      = null;
        let start_date = null;
        let end_date   =  null;

        $(document).ready(function() {
            filterJobs(null, null, null, page = 1);
        });

        $(document).on('click', '#pagination .page-link', function() {
            page = $(this).data('page');
            filterJobs(start_date, end_date, query, page);
        });

        $(document).on('change', '.start_date', function(e) {
            start_date = $(this).val();
            filterJobs(start_date, end_date, query, page = 1);
        })

        $(document).on('change', '.end_date', function(e) {
            end_date = $(this).val();
            filterJobs(start_date, end_date, query, page = 1);
        })

        $(document).on('click', '.btn-clear', function() {
            $('.date').val('')
            filterJobs(null, null,query, page = 1);
        })

        $(document).on('keypress', '.query', function(e) {
            if (e.keyCode === 13) {
                query = $(this).val();
                filterJobs(start_date, end_date, query, page = 1);
            }
        })

        $(document).on('click', '.btn-search', function() {
            query = $('.query').val();
            filterJobs(start_date, end_date, query, page = 1);
        })

        function filterJobs(start_date, end_date, query, page = 1) {
            var formData = new FormData();

            formData.append('_token', "{{ csrf_token() }}");
            formData.append('page', page);
            formData.append('search_query', query)
            formData.append('start_date', start_date)
            formData.append('end_date', end_date)

            // Send an AJAX request to validate the data
            $.ajax({
                url: '{{ route('applicant.postAppliedJobs') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    let html = ''
                    if (response.data.length > 0) {
                        // Sort jobs by application date in descending order
                        response.data.sort((a, b) => new Date(b.applications[0].created_at) - new Date(a.applications[0].created_at));

                        $.each(response.data, function(index, val) {

                            let salary = parseFloat(val.salary).toLocaleString(undefined, {
                                style: 'currency',
                                currency: 'PHP',
                            });

                            if (val.hide_salary === 1){
                                salary = '*'.repeat(salary.toString().length);
                                salary = `<span>&#8369; ${salary}<span>`
                            }

                            let job_status = "Apply Again";
                            if (val.applications.length > 0 && val.applications[0].status !== 'Withdrawn') {
                                job_status = "Withdraw"
                            } 

                            let company_logo = val.employer.company_logo.replace('public', 'storage')
                            let job_vacancy  = val.status == 1 ? 'Open' : 'Closed';

                            let rejected_reason = ''
                            let rejected = ''
                            if (val.applications[0].is_rejected === 1) {
                                rejected_reason = `<i class="fa-regular fa-circle-xmark text-primary me-2"></i> Rejected Reason: <b>${val.applications[0].rejected_reason}<b>`

                                rejected = 'rejected'
                            }

                            let statuses    = ["Applied", "Initial Interview","Exam","Final Interview","Hired","Rejected"];
                            let key_counter = 1;
                            let status_html = ''
                            let app_status = val.applications[0].status

                            status_html += `<div class="btn-group" role="group">`

                            $.each(statuses, function(index, status) {
                            if (status != "Rejected") {
                                const isCurrentStatus = app_status === status;
                                const isRejected = isCurrentStatus && val.applications[0].is_rejected === 1;
                                const btnClass = isRejected ? 'btn-danger' : (isCurrentStatus ? 'btn-success' : 'btn-outline-dark');

                                status_html += `<button type="button" class="btn ${btnClass}">
                                    <span class="badge bg-warning text-dark">${key_counter++}</span>
                                    ${status} <i class="fa-solid fa-caret-right"></i>
                                </button>`;
                            }
                        });

                        getPagination(response);

                            if (app_status == "Withdrawn") {
                                status_html += `<button type="button" class="btn btn-secondary">
                                    <span class="badge bg-warning text-dark">${key_counter++}</span>
                                    Withdrawn
                                </button>`
                            }
                        
                            status_html += `</div>`

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
                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                            <a class="btn btn-primary btn-apply" href="{{url('/applicant/job-details/${val.id}')}}">${job_status}</a>
                                        </div>
                                        <small class="text-truncate">
                                            <i class="far fa-calendar-alt text-primary me-2"></i>
                                            Date Posted ${moment(val.created_at).format('M/D/YYYY')}
                                        </small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <p>
                                            <span class="text-truncate me-3">
                                                <i class="far fa-calendar-alt text-primary me-2"></i>
                                                Date Applied: ${moment(val.applications[0].created_at).format('M/D/YYYY')}
                                            </span>
                                            <span class="text-truncate me-3">
                                                <i class="fa-solid fa-circle-info text-primary me-2"></i>
                                                Job Status: ${job_vacancy}
                                            </span>
                                            <span class="text-truncate me-3">
                                                ${rejected_reason}
                                            </span>
                                        </p>
                                        <div class="mb-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p class="mb-0 fw-bold">Cover Letter</p>
                                                    <span class="fw-light">${val.applications[0].cover_letter}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="application-status">
                                            <p>Application Status</p>
                                            ${status_html}
                                        </div>
                                    </div>
                                </div>
                            </div>`
                        })

                        getPagination(response)

                    } else {
                        html += `<h4 class="text-center">No applied jobs available at the moment.</h4>`

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
