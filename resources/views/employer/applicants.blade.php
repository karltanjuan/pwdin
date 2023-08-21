@extends('employer.layouts.master')

@section('title', 'Employer - Applicants')

@section('content')
    <style>
        .modal-view-applicant .content > div {
            border: 1px solid #333;
            padding: 5px;
        }

        .modal-view-applicant .content > div:last-child > div {
            padding-left: 30px;
        }
    </style>

    <div class="head-container">
        <h1>Applicants</h1>
    </div>  

    <table class="applicants-table">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Education Level</th>
                <th>Mobile Number</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Date Applied</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($applicants) > 0)
                @foreach ($applicants as $app)
                <tr>
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
                    <td>{{ $app->status }}</td>
                    <td>
                        <button class="btn-view" id="btn-view" data-id="{{ $app->applicant->id }}">
                            <i class="fa-regular fa-eye"></i>
                        </button>
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
    
    <!-- modal -->
    <div id="modal-add-job" class="modal modal-add-job">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Post Job</h2>
                <span class="modal-close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="content">
                <div id="form">
                    <div class="form first" id="form-first">
                        <div class="details personal">
                            <div class="fields">
                                <div class="input-field">
                                    <label>Job Title</label>
                                    <input id="job_title" class="job_title" type="text" placeholder="Enter job title"/>
                                    <span class="err-job_title err-msg"></span>
                                </div>
                                <div class="input-field">
                                    <label>Career Level</label>
                                    <select class="career_level" id="career_level">
                                        <option value="Intern Level">Intern Level</option>
                                        <option value="Entry Level">Entry Level</option>
                                        <option value="Associate Level">Associate Level</option>
                                        <option value="Mid-Senior Level">Mid-Senior Level</option>
                                        <option value="Director">Director</option>
                                    </select>
                                    <span class="err-career_level err-msg"></span>
                                </div>
                                <div class="input-field">
                                    <label>Job Type</label>
                                    <select class="job_type" id="job_type">
                                        <option value="Full-time">Full-time</option>
                                        <option value="Part-time">Part-time</option>
                                        <option value="Internship">Internship</option>
                                        <option value="Contract">Contract</option>
                                    </select>
                                    <span class="err-job_type err-msg"></span>
                                </div>
                                <div class="input-field">
                                    <label>Industry</label>
                                    <select class="job_industry" id="job_industry">
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
                                        <option value="Healtcare">Healtcare</option>
                                        <option value="Journalist/Editors">Journalist/Editors</option>
                                        <option value="General Work">General Work</option>
                                        <option value="Publishing">Publishing</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <span class="err-job_industry err-msg"></span>
                                </div>
                                <div class="input-field">
                                    <label>Years of Experience</label>
                                    <input class="years_experience" id="years_experience" type="number" placeholder="Enter years of experience">
                                    <span class="err-years_experience err-msg"></span>
                                </div>
                                <div class="input-field">
                                    <label>Average Processing Days</label>
                                    <input class="average_processing_time" id="average_processing_time" type="number" placeholder="Enter days">
                                    <span class="err-average_processing_time err-msg"></span>
                                </div>
                                <div class="input-field">
                                    <label>Salary</label>
                                    <input class="salary" id="salary" type="number" placeholder="Enter salary">
                                    <span class="err-salary err-msg"></span>
                                </div>
                                <div class="input-field">
                                    <label>Educational Attainment</label>
                                    <select class="qualification" id="qualification">
                                        <option value="Grade School">Grade School</option>
                                        <option value="High School">High School</option>
                                        <option value="Bachelor's Degree">Bachelor's Degree</option>
                                        <option value="Vocational">Vocational</option>
                                        <option value="Post-Graduate">Post-Graduate</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <span class="err-qualification err-msg"></span>
                                </div>
                                <div class="input-field">
                                    <label>Work Setup</label>
                                    <select class="work_setup" id="work_setup">
                                        <option value="Onsite">Onsite</option>
                                        <option value="Remote">Remote</option>
                                        <option value="Hybrid">Hybrid</option>
                                    </select>
                                    <span class="err-work_setup err-msg"></span>
                                </div>
                                <div class="input-field">
                                    <label>Working Days</label>
                                    <select class="working_days" id="working_days" name="working_days[]" multiple="multiple">
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Sunday">Sunday</option>
                                    </select>
                                    <span class="err-working_days err-msg"></span>
                                </div>
                                <div class="input-field">
                                    <label>PWD Categories</label>
                                    <select class="pwd_categories" id="pwd_categories" name="pwd_categories[]" multiple="multiple">
                                        <option value="Psychosocial">Psychosocial</option>
                                        <option value="Mental">Mental</option>
                                        <option value="Chronic illness">Chronic illness</option>
                                        <option value="Learning">Learning</option>
                                        <option value="Visual">Visual</option>
                                        <option value="Orthopedic">Orthopedic</option>
                                        <option value="Communication">Communication</option>
                                    </select>
                                    <span class="err-pwd_categories err-msg"></span>
                                </div>
                                <div class="input-field">
                                    <label>Status</label>
                                    <select class="status" id="status">
                                        <option value="1">Open</option>
                                        <option value="0">Closed</option>
                                    </select>
                                    <span class="err-status err-msg"></span>
                                </div>
                                <div class="input-field"></div>
                            </div>
                            <div class="input-field">
                                <label>Job Description</label>
                                <textarea rows="2" id="job_description" class="job_description" placeholder="Enter job description">Enter job description and optional disclaimer.</textarea>
                                <span class="err-job_description err-msg"></span>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="primary-btn btn-save">Save</button>
                <button class="secondary-btn btn-cancel">Cancel</button>
            </div>
        </div>
    </div>

    <div id="modal-delete-job" class="modal modal-delete-job">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Delete Job</h2>
                <span class="modal-close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="content">
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button class="danger-btn btn-remove">Yes</button>
                    <button class="secondary-btn btn-cancel">No</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-view-applicant" class="modal modal-view-applicant">
        <div class="modal-content">
            <div class="modal-header">
                <h2>View Applicant</h2>
                <span class="modal-close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="content">
                </div>
                <div class="modal-footer">
                    <button class="secondary-btn btn-cancel">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-confirm-application" class="modal modal-confirm-application">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Update Application</h2>
                <span class="modal-close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="content">
                    Are you sure you want to continue?
                </div>
                <div class="modal-footer">
                    <button class="primary-btn btn-update">Yes</button>
                    <button class="secondary-btn btn-cancel">No</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script>
        var id = 0;
        $(document).ready(function() {
            getAppStatus()
        })

        $(".check-all").click(function() {
            var isChecked = $(this).prop("checked");
            $("input[type='checkbox']").prop("checked", isChecked);
        });

        $("input[type='checkbox']:not(.check-all)").click(function() {
            var other_checkbox = ($("input[type='checkbox']:not(.check-all)").length === $("input[type='checkbox']:not(.check-all):checked").length);
            $(".check-all").prop("checked", other_checkbox);
        });

        function getApplicantById(id) {
            job_id = "{{ request()->route('id') }}"

            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('job_id', parseInt(job_id));
            formData.append('applicant_id', parseInt(id));

            // Send an AJAX request to validate the data
            $.ajax({
                url: '{{ route('employer.getApplicantById') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    var applicant   = response.applicants[0].applicant
                    var application = response.applicants[0]
                    var app_status  = JSON.parse(response.app_status[0].name)

                    var pwd_card = applicant.pwd_card.replace('public', 'storage')
                    var resume = applicant.resume.replace('public', 'storage')
                    var profile_photo = applicant.profile_photo.replace('public', 'storage')

                    $('.modal-view-applicant .content').html(`
                        <div>Full Name: ${applicant.first_name} ${applicant.middle_name} ${applicant.last_name} ${applicant.prefix !== null ? applicant.prefix : ''}</div>
                        <div>PWD Category: ${applicant.pwd_categories}</div>
                        <div>PWD Card: <a href='{{asset('${pwd_card}')}}' target='_blank'>View and Download</a></div>
                        <div>Resume: <a href='{{asset('${resume}')}}' target='_blank'>View and Download</a></div>

                        <div><p>Profile Photo:</p> <img class="img-fluid" src='{{asset('${profile_photo}')}}' alt='Profile Photo'/></div>

                        <div>Education Level: ${applicant.education_level}</div>
                        <div>Mobile Number: ${applicant.mobile_no}</div>
                        <div>Email Address: ${applicant.email}</div>
                        <div>Gender: ${applicant.gender}</div>
                        <div>Date Applied: ${moment(application.created_at).format('LL')}</div>
                        <div>Birthdate: ${moment(applicant.birthdate).format('LL')}</div>
                        <div>Full Address: ${applicant.address}, ${applicant.city}, ${applicant.province}, ${applicant.zip_code}</div>
                        <div>Cover Letter: ${application.cover_letter}</div>
                        <div>
                            <span>Update Status:</span>
                            <select class="status cm-input" id="status" data-id="${application.id}"></select>
                        </div>
                    `)

                    var html = ""
                    $.each(app_status, function(index,val) {
                        if (application.status == val) {
                            html += `<option value="${val}" selected>${val}</option>`
                        } else {
                            html += `<option value="${val}">${val}</option>`
                        }
                    });

                    $('.status').html(html)
                },
                error: function(xhr, status, error) {
                    var result = JSON.parse(xhr.responseText)
                    console.log(result.errors)
                }
            });
        }

        function getAppStatus() {

            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");

            $.ajax({
                url: '{{ route('employer.getAppStatus') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var name = JSON.parse(response[0].name)
                    var html = ""

                    $.each(name, function(index, value) {
                        html += `<option>${value}</option>`
                    });

                    $('.status').html(html)

                },
                error: function(xhr, status, error) {
                    
                }
            });
        }

        $(document).on('click', '.btn-view', function() {
            id = $(this).data('id')
            getApplicantById(id)
            $('.modal-view-applicant').show();
        })

        function closeModal() {
            $(".modal").css("display", "none");
        }

        $(document).on('click', '.modal-close, .btn-cancel', function() {
            closeModal()
        })

        var datatable_job = $('.applicants-table').DataTable({
            "lengthChange": false,
            "iDisplayLength" : 10,
            // "order": [[0, 'asc']],
        });

        var err_counter = 0;
        function displayErrors(errors) {
            $('.err-msg').text('');
            $('.err-msg').siblings('input, select').removeClass('error');

            // loop all the error messages from backend to display on ui
            $.each(errors, function(field, messages) {
                var errMsgSelector = '.err-' + field;
                var inputSelector = '#' + field;
                $(errMsgSelector).text(messages[0]);
                $(inputSelector).addClass('error');
            });

            $("html, body").animate({ scrollTop: 0 }, "slow");
        }

        var global_status = "";
        var global_id = 0;
        $(document).on('change', '.status', function() {
            global_id = parseInt($(this).data('id'));
            global_status = $(this).val();

            $('#modal-confirm-application').show()
        })

        $(document).on('click', '.btn-update', function() {
             // data to be uploaded on ajax
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', global_id);
            formData.append('status', global_status);

            $.ajax({
                url: '{{ route('employer.updateAppStatus') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                        $('.modal').hide()

                        Swal.fire({
                          title: 'Application Status Updated',
                          text: 'Success',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonText: 'OK'
                        });

                        setTimeout(function() {
                            window.location.href = '{{url('/employer/jobs/')}}/{{request()->route('id')}}/applicants'
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