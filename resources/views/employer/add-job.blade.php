@extends('employer.layouts.master')

@php $page_title = "Add Job"; @endphp

@section('title', 'Employer - ' . $page_title)
@section('cover_page')
    <li class="breadcrumb-item text-white">
        <a href="{{ url('employer/jobs') }}">Jobs</a>
    </li>
    <li class="breadcrumb-item text-white active">{{ $page_title }}</li>
@endsection

@section('content')
    <style>
        .select2-selection {
            min-height: 58px !important;
        }
    </style>

    @php
        $user = auth()
            ->guard('employers')
            ->user();
    @endphp

    <h1 class="text-center mb-5 wow fadeInUp title-label" data-wow-delay="0.1s">Add New Job</h1>

    <div class="row wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-outline mb-4 form-floating">
                                <input type="text" id="job_title" class="form-control form-control-lg job_title"
                                    placeholder="Enter job title" tabindex="1" value="" />
                                <label class="form-label" for="job_title">Job Title</label>
                                <span class="err-job_title err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4">
                                <select class="career_level form-select" id="career_level" tabindex="2">
                                    <option value="Intern Level">Intern Level</option>
                                    <option value="Entry Level">Entry Level</option>
                                    <option value="Associate Level">Associate Level</option>
                                    <option value="Mid Level">Mid Level</option>
                                    <option value="Senior Level">Senior Level</option>
                                    <option value="Director">Director</option>
                                </select>
                                <label for="career_level">Career Level</label>
                                <span class="err-career_level err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4">
                                <select class="job_type form-select" id="job_type" tabindex="3">
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Internship">Internship</option>
                                    <option value="Contract">Contract</option>
                                </select>
                                <label for="job_type">Job Type</label>
                                <span class="err-job_type err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4">
                                <select class="job_industry form-select" id="job_industry" tabindex="4">
                                    <option value="Accounting/Finance">Accounting/Finance</option>
                                    <option value="Admin/Human Resources">Admin/Human Resources</option>
                                    <option value="Sales/Marketing">Sales/Marketing</option>
                                    <option value="Arts/Media/Communication">Arts/Media/Communication</option>
                                    <option value="Services">Services</option>
                                    <option value="Hotel/Restaurant">Hotel/Restaurant</option>
                                    <option value="Education/Training">Education/Training</option>
                                    <option value="Computer/Information Technology">Computer/Information Technology
                                    </option>
                                    <option value="Engineering">Engineering</option>
                                    <option value="Manufacturing">Manufacturing</option>
                                    <option value="Building/Construction">Building/Construction</option>
                                    <option value="Sciences">Sciences</option>
                                    <option value="Healtcare">Healtcare</option>
                                    <option value="Journalist/Editors">Journalist/Editors</option>
                                    <option value="General Work">General Work</option>
                                    <option value="Publishing">Publishing</option>
                                    <option value="Others">Others</option>
                                </select>
                                <label for="job_industry">Job Industry</label>
                                <span class="err-job_industry err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-outline mb-4 form-floating">
                                <input type="number" id="years_experience"
                                    class="form-control form-control-lg years_experience"
                                    placeholder="Enter years of experience" tabindex="5" value="0"/>
                                <label class="form-label" for="years_experience">Years of Experience</label>
                                <span class="err-years_experience err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-outline mb-4 form-floating">
                                <input type="number" id="average_processing_time"
                                    class="form-control form-control-lg average_processing_time" placeholder="Enter days"
                                    tabindex="6" value="" />
                                <label class="form-label" for="average_processing_time">Average Processing Time</label>
                                <span class="err-average_processing_time err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-outline mb-4 form-floating">
                                <input type="number" id="salary" class="form-control form-control-lg salary"
                                    placeholder="Enter salary" tabindex="7" value="" />
                                <label class="form-label" for="salary">Salary</label>
                                <span class="err-salary err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input hide_salary" type="checkbox" value="0"
                                    id="hide_salary" tabindex="8">
                                <label class="form-check-label" for="hide_salary">Hide Salary</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating mb-4">
                                <select class="qualification form-select" id="qualification" tabindex="9">
                                    <option value="Grade School">Grade School</option>
                                    <option value="High School">High School</option>
                                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                                    <option value="Vocational">Vocational</option>
                                    <option value="Post-Graduate">Post-Graduate</option>
                                    <option value="Others">Others</option>
                                </select>
                                <label for="qualification">Educational Attainment</label>
                                <span class="err-qualification err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4">
                                <select class="work_setup form-select" id="work_setup" tabindex="10">
                                    <option value="Onsite">Onsite</option>
                                    <option value="Remote">Remote</option>
                                    <option value="Hybrid">Hybrid</option>
                                </select>
                                <label for="work_setup">Work Setup</label>
                                <span class="err-work_setup err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4">
                                <select class="working_days form-select" id="working_days" tabindex="11"
                                    name="working_days[]" multiple="multiple">
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                                <label for="working_days">Working Days</label>
                                <span class="err-working_days err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4">
                                <select class="pwd_categories form-select" id="pwd_categories" tabindex="12"
                                    name="pwd_categories[]" multiple="multiple">
                                    <option value="Psychosocial">Psychosocial</option>
                                    <option value="Mental">Mental</option>
                                    <option value="Physical">Physical</option>
                                    <option value="Chronic illness">Chronic illness</option>
                                    <option value="Learning">Learning</option>
                                    <option value="Visual">Visual</option>
                                    <option value="Orthopedic">Orthopedic</option>
                                    <option value="Communication">Communication</option>
                                    <option value="Deaf">Deaf/Hard of Hearing</option>
                                    <option value="Intellectual">Intellectual</option>
                                    <option value="Speech">Speech and Language</option>
                                    <option value="Cancer">Cancer</option>
                                    <option value="Rare">Rare Disease</option>
                                </select>
                                <label for="pwd_categories">PWD Categories</label>
                                <span class="err-pwd_categories err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4">
                                <select class="status form-select" id="status" tabindex="13">
                                    <option value="1">Open</option>
                                    <option value="0">Closed</option>
                                </select>
                                <label for="status">Status</label>
                                <span class="err-status err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea class="form-control job_description" id="job_description" rows="14" style="height:100px;"
                                    placeholder="Job Description"></textarea>
                                <label for="job_description">Enter job description and optional disclaimer.</label>
                                <span class="err-job_description err-msg"></span>
                            </div>
                        </div>

                        <div class="text-center text-lg-start pt-2">
                            <button type="button" class="btn-save btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Save Job</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('employer.layouts.scripts')

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(document).ready(function() {
            tinymce.init({
                selector: 'textarea#job_description',
                plugins: 'powerpaste advcode table lists checklist emoticons',
                toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table | emoticons'
            });

            $('.working_days').select2();
            $('.pwd_categories').select2();
        })

        $(document).on('change', '.career_level', function() {
            if ($(this).val() == "Intern Level") {
                $('.years_experience').val(0)
            } else if ($(this).val() == "Entry Level") {
                $('.years_experience').val(1)
            } else if ($(this).val() == "Associate Level") {
                $('.years_experience').val(2)
            } else if ($(this).val() == "Mid Level") {
                $('.years_experience').val(3)
            } else if ($(this).val() == "Senior Level") {
                $('.years_experience').val(4)
            } else if ($(this).val() == "Director") {
                $('.years_experience').val(5)
            }
        })


        $(document).on('change', '.working_days', function() {
            if ($(this).val() != '') {
                $('label[for="working_days"]').css('z-index', '-1')
            } else {
                $('label[for="working_days"]').css('z-index', '0')
            }
        })

        $(document).on('change', '.pwd_categories', function() {
            if ($(this).val() != '') {
                $('label[for="pwd_categories"]').css('z-index', '-1')
            } else {
                $('label[for="pwd_categories"]').css('z-index', '0')
            }
        })

        let click_counter = 0;

        $('.btn-save').on('click', function() {
            $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`);

            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('job_title', $('#job_title').val());
            formData.append('career_level', $('#career_level').val());
            formData.append('job_type', $('#job_type').val());
            formData.append('job_industry', $('#job_industry').val());
            formData.append('years_experience', $('#years_experience').val());
            formData.append('average_processing_time', $('#average_processing_time').val());
            formData.append('salary', $('#salary').val());
            formData.append('hide_salary', $('#hide_salary').prop('checked'));
            formData.append('qualification', $('#qualification').val());
            formData.append('work_setup', $('#work_setup').val());
            formData.append('working_days', $('#working_days').val().join());
            formData.append('pwd_categories', $('#pwd_categories').val().join());
            formData.append('job_description', tinymce.get("job_description").getContent());
            formData.append('status', $('#status').val());

            if (click_counter === 0) {
                click_counter++;
                $(this).prop('disabled', true);

                $.ajax({
                    url: '{{ route('employer.postJob') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.code == "200") {
                            $('.btn-save').html(`Save Job`);
                            toastr.success('New job created successfully', 'Success')

                            setTimeout(function() {
                                window.location.href = '{{ url('/employer/jobs') }}'
                            }, 2000)
                        } else {
                            displayErrors(JSON.parse(response.errors));
                            $('.btn-save').html(`Save Job`).prop('disabled', false);
                            click_counter = 0;
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle the AJAX request error
                        var result = JSON.parse(xhr.responseText)
                        displayErrors(result.errors)
                        $('.btn-save').html(`Save Job`).prop('disabled', false);
                            click_counter = 0;
                    }
                });
            }

        })
    </script>
@endsection
