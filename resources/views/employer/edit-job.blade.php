@extends('employer.layouts.master')

@php $page_title = "Edit Job"; @endphp

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

    <h1 class="text-center mb-5 wow fadeInUp title-label" data-wow-delay="0.1s">{{ $page_title }}</h1>

    <div class="row wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-outline mb-4 form-floating">
                                <input type="text" id="job_title" class="form-control form-control-lg job_title"
                                    placeholder="Enter job title" tabindex="1" value="{{ $job->job_title }}" />
                                <label class="form-label" for="job_title">Job Title</label>
                                <span class="err-job_title err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4">
                                <select class="career_level form-select" id="career_level" tabindex="2">
                                    <option value="Intern Level"
                                        {{ $job->career_level === 'Intern Level' ? 'selected' : '' }}>Intern Level</option>
                                    <option value="Entry Level"
                                        {{ $job->career_level === 'Entry Level' ? 'selected' : '' }}>Entry Level</option>
                                    <option value="Associate Level"
                                        {{ $job->career_level === 'Associate Level' ? 'selected' : '' }}>Associate Level
                                    </option>
                                    <option value="Mid-Senior Level"
                                        {{ $job->career_level === 'Mid-Senior Level' ? 'selected' : '' }}>Mid-Senior Level
                                    </option>
                                    <option value="Director" {{ $job->career_level === 'Director' ? 'selected' : '' }}>
                                        Director</option>
                                </select>
                                <label for="career_level">Career Level</label>
                                <span class="err-career_level err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4">
                                <select class="job_type form-select" id="job_type" tabindex="3">
                                    <option value="Full-time" {{ $job->job_type === 'Full-time' ? 'selected' : '' }}>
                                        Full-time</option>
                                    <option value="Part-time" {{ $job->job_type === 'Part-time' ? 'selected' : '' }}>
                                        Part-time</option>
                                    <option value="Internship" {{ $job->job_type === 'Internship' ? 'selected' : '' }}>
                                        Internship</option>
                                    <option value="Contract" {{ $job->job_type === 'Contract' ? 'selected' : '' }}>Contract
                                    </option>
                                </select>
                                <label for="job_type">Job Type</label>
                                <span class="err-job_type err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4">
                                <select class="job_industry form-select" id="job_industry" tabindex="4">
                                    <option value="Accounting/Finance"
                                        {{ $job->job_industry === 'Accounting/Finance' ? 'selected' : '' }}>
                                        Accounting/Finance</option>
                                    <option value="Admin/Human Resources"
                                        {{ $job->job_industry === 'Admin/Human Resources' ? 'selected' : '' }}>Admin/Human
                                        Resources</option>
                                    <option value="Sales/Marketing"
                                        {{ $job->job_industry === 'Sales/Marketing' ? 'selected' : '' }}>Sales/Marketing
                                    </option>
                                    <option value="Arts/Media/Communication"
                                        {{ $job->job_industry === 'Arts/Media/Communication' ? 'selected' : '' }}>
                                        Arts/Media/Communication</option>
                                    <option value="Services" {{ $job->job_industry === 'Services' ? 'selected' : '' }}>
                                        Services</option>
                                    <option value="Hotel/Restaurant"
                                        {{ $job->job_industry === 'Hotel/Restaurant' ? 'selected' : '' }}>Hotel/Restaurant
                                    </option>
                                    <option value="Education/Training"
                                        {{ $job->job_industry === 'Education/Training' ? 'selected' : '' }}>
                                        Education/Training</option>
                                    <option value="Computer/Information Technology"
                                        {{ $job->job_industry === 'Computer/Information Technology' ? 'selected' : '' }}>
                                        Computer/Information Technology</option>
                                    <option value="Engineering"
                                        {{ $job->job_industry === 'Engineering' ? 'selected' : '' }}>Engineering</option>
                                    <option value="Manufacturing"
                                        {{ $job->job_industry === 'Manufacturing' ? 'selected' : '' }}>Manufacturing
                                    </option>
                                    <option value="Building/Construction"
                                        {{ $job->job_industry === 'Building/Construction' ? 'selected' : '' }}>
                                        Building/Construction</option>
                                    <option value="Sciences" {{ $job->job_industry === 'Sciences' ? 'selected' : '' }}>
                                        Sciences</option>
                                    <option value="Healthcare" {{ $job->job_industry === 'Healthcare' ? 'selected' : '' }}>
                                        Healthcare</option>
                                    <option value="Journalist/Editors"
                                        {{ $job->job_industry === 'Journalist/Editors' ? 'selected' : '' }}>
                                        Journalist/Editors</option>
                                    <option value="General Work"
                                        {{ $job->job_industry === 'General Work' ? 'selected' : '' }}>General Work</option>
                                    <option value="Publishing" {{ $job->job_industry === 'Publishing' ? 'selected' : '' }}>
                                        Publishing</option>
                                    <option value="Others" {{ $job->job_industry === 'Others' ? 'selected' : '' }}>Others
                                    </option>
                                </select>
                                <label for="job_industry">Job Industry</label>
                                <span class="err-job_industry err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-outline mb-4 form-floating">
                                <input type="number" id="years_experience"
                                    class="form-control form-control-lg years_experience"
                                    placeholder="Enter years of experience" tabindex="5"
                                    value="{{ $job->years_experience }}" />
                                <label class="form-label" for="years_experience">Years of Experience</label>
                                <span class="err-years_experience err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-outline mb-4 form-floating">
                                <input type="number" id="average_processing_time"
                                    class="form-control form-control-lg average_processing_time" placeholder="Enter days"
                                    tabindex="6" value="{{ $job->average_processing_time }}" />
                                <label class="form-label" for="average_processing_time">Average Processing Iime</label>
                                <span class="err-average_processing_time err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-outline mb-4 form-floating">
                                <input type="number" id="salary" class="form-control form-control-lg salary"
                                    placeholder="Enter salary" tabindex="7" value="{{ $job->salary }}" />
                                <label class="form-label" for="salary">Salary</label>
                                <span class="err-salary err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input hide_salary" type="checkbox" value="0"
                                    id="hide_salary" tabindex="8" {{ $job->hide_salary ? 'checked' : '' }}>
                                <label class="form-check-label" for="hide_salary">Hide Salary</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating mb-4">
                                <select class="qualification form-select" id="qualification" tabindex="9">
                                    <option value="Grade School"
                                        {{ $job->qualification === 'Grade School' ? 'selected' : '' }}>Grade School
                                    </option>
                                    <option value="High School"
                                        {{ $job->qualification === 'High School' ? 'selected' : '' }}>
                                        High School</option>
                                    <option value="Bachelor's Degree"
                                        {{ $job->qualification === "Bachelor's Degree" ? 'selected' : '' }}>Bachelor's
                                        Degree
                                    </option>
                                    <option value="Vocational"
                                        {{ $job->qualification === 'Vocational' ? 'selected' : '' }}>
                                        Vocational</option>
                                    <option value="Post-Graduate"
                                        {{ $job->qualification === 'Post-Graduate' ? 'selected' : '' }}>Post-Graduate
                                    </option>
                                    <option value="Others" {{ $job->qualification === 'Others' ? 'selected' : '' }}>Others
                                    </option>
                                </select>

                                <label for="qualification">Educational Attainment</label>
                                <span class="err-qualification err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4">
                                <select class="work_setup form-select" id="work_setup" tabindex="10">
                                    <option value="Onsite" {{ $job->work_setup === 'Onsite' ? 'selected' : '' }}>Onsite
                                    </option>
                                    <option value="Remote" {{ $job->work_setup === 'Remote' ? 'selected' : '' }}>Remote
                                    </option>
                                    <option value="Hybrid" {{ $job->work_setup === 'Hybrid' ? 'selected' : '' }}>Hybrid
                                    </option>
                                </select>
                                <label for="work_setup">Work Setup</label>
                                <span class="err-work_setup err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4">
                                <select class="working_days form-select" id="working_days" tabindex="11"
                                    name="working_days[]" multiple="multiple">
                                    <option value="Monday"
                                        {{ in_array('Monday', explode(',', $job->working_days)) ? 'selected' : '' }}>Monday
                                    </option>
                                    <option value="Tuesday"
                                        {{ in_array('Tuesday', explode(',', $job->working_days)) ? 'selected' : '' }}>
                                        Tuesday</option>
                                    <option value="Wednesday"
                                        {{ in_array('Wednesday', explode(',', $job->working_days)) ? 'selected' : '' }}>
                                        Wednesday</option>
                                    <option value="Thursday"
                                        {{ in_array('Thursday', explode(',', $job->working_days)) ? 'selected' : '' }}>
                                        Thursday</option>
                                    <option value="Friday"
                                        {{ in_array('Friday', explode(',', $job->working_days)) ? 'selected' : '' }}>Friday
                                    </option>
                                    <option value="Saturday"
                                        {{ in_array('Saturday', explode(',', $job->working_days)) ? 'selected' : '' }}>
                                        Saturday</option>
                                    <option value="Sunday"
                                        {{ in_array('Sunday', explode(',', $job->working_days)) ? 'selected' : '' }}>Sunday
                                    </option>
                                </select>

                                <label for="working_days">Working Days</label>
                                <span class="err-working_days err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4">
                                <select class="pwd_categories form-select" id="pwd_categories" tabindex="12"
                                    name="pwd_categories[]" multiple="multiple">
                                    <option value="Psychosocial"
                                        {{ in_array('Psychosocial', explode(',', $job->pwd_categories)) ? 'selected' : '' }}>
                                        Psychosocial</option>
                                    <option value="Mental"
                                        {{ in_array('Mental', explode(',', $job->pwd_categories)) ? 'selected' : '' }}>
                                        Mental</option>
                                    <option value="Physical"
                                        {{ in_array('Physical', explode(',', $job->pwd_categories)) ? 'selected' : '' }}>
                                        Physical</option>
                                    <option value="Chronic illness"
                                        {{ in_array('Chronic illness', explode(',', $job->pwd_categories)) ? 'selected' : '' }}>
                                        Chronic illness</option>
                                    <option value="Learning"
                                        {{ in_array('Learning', explode(',', $job->pwd_categories)) ? 'selected' : '' }}>
                                        Learning</option>
                                    <option value="Visual"
                                        {{ in_array('Visual', explode(',', $job->pwd_categories)) ? 'selected' : '' }}>
                                        Visual</option>
                                    <option value="Orthopedic"
                                        {{ in_array('Orthopedic', explode(',', $job->pwd_categories)) ? 'selected' : '' }}>
                                        Orthopedic</option>
                                    <option value="Communication"
                                        {{ in_array('Communication', explode(',', $job->pwd_categories)) ? 'selected' : '' }}>
                                        Communication</option>
                                    <option value="Deaf"
                                        {{ in_array('Deaf/Hard of Hearing', explode(',', $job->pwd_categories)) ? 'selected' : '' }}>
                                        Deaf/Hard of Hearing</option>
                                    <option value="Intellectual"
                                        {{ in_array('Intellectual', explode(',', $job->pwd_categories)) ? 'selected' : '' }}>
                                        Intellectual</option>
                                    <option value="Speech"
                                        {{ in_array('Speech', explode(',', $job->pwd_categories)) ? 'selected' : '' }}>
                                        Speech and Language</option>
                                    <option value="Cancer"
                                        {{ in_array('Cancer', explode(',', $job->pwd_categories)) ? 'selected' : '' }}>
                                        Cancer</option>
                                    <option value="Rare"
                                        {{ in_array('Rare', explode(',', $job->pwd_categories)) ? 'selected' : '' }}>
                                        Rare Disease</option>
                                </select>
                                <label for="pwd_categories">PWD Categories</label>
                                <span class="err-pwd_categories err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-4">
                                <select class="status form-select" id="status" tabindex="13">
                                    <option value="1" {{ $job->status == 1 ? 'selected' : '' }}>Open</option>
                                    <option value="0" {{ $job->status == 0 ? 'selected' : '' }}>Closed</option>
                                </select>
                                <label for="status">Status</label>
                                <span class="err-status err-msg"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea class="form-control job_description" id="job_description" rows="14" style="height:100px;"
                                    placeholder="Job Description">{!! $job->job_description !!}</textarea>
                                <label for="job_description">Enter job description and optional disclaimer.</label>
                                <span class="err-job_description err-msg"></span>
                            </div>
                        </div>

                        <div class="text-center text-lg-start pt-2">
                            <button type="button" class="btn-update btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Update Job</button>
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

            $('label[for="working_days"]').css('z-index', '-1')
            $('label[for="pwd_categories"]').css('z-index', '-1')
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


        $('.btn-update').on('click', function() {
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', '{{ request()->segment(4) }}');
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

            $.ajax({
                url: '{{ route('employer.updateJob') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response)
                    if (response.code == "200") {
                        toastr.success('Job updated successfully', 'Success')

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
