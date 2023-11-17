@extends('employer.layouts.master')

@section('title', 'Employer - Change Password')
@section('cover_page')
    <li class="breadcrumb-item text-white active">Settings</li>
    <li class="breadcrumb-item text-white active">Change Password</li>
@endsection

@section('content')
    <style>
        .eye-icon-position {
            margin-top: -40px;
        }
    </style>

    <h1 class="text-center mb-1 wow fadeInUp title-label" data-wow-delay="0.1s">Change Password</h1>
    <p class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s"><b>Note</b>: Strong password should be 8 characters long or more.</p>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <!-- Current password input -->
                    <div class="form-outline mb-3 form-floating">
                        <input type="password" id="current_password" class="form-control form-control-lg current_password"
                            placeholder="Enter current password" />
                        <label class="form-label" for="current_password">Current Password</label>
                        <span class="show eye-icon-position">
                            <i class="las la-eye fs-5" id="show4" onclick="toggle4()"></i>
                        </span>
                        <span class="err-current_password err-msg"></span>
                    </div>

                    <!-- New password input -->
                    <div class="form-outline mb-3 form-floating">
                        <input type="password" id="new_password" class="form-control form-control-lg new_password"
                            placeholder="Enter new password" />
                        <label class="form-label" for="new_password">New Password</label>
                        <span class="show eye-icon-position">
                            <i class="las la-eye fs-5" id="show1" onclick="toggle1()"></i>
                        </span>
                        <span class="err-new_password err-msg"></span>
                    </div>

                    <!-- Confirm password input -->
                    <div class="form-outline mb-3 form-floating">
                        <input type="password" id="password_confirmation"
                            class="form-control form-control-lg password_confirmation"
                            placeholder="Enter password confirmation" />
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        <span class="show eye-icon-position">
                            <i class="las la-eye fs-5" id="show2" onclick="toggle2()"></i>
                        </span>
                        <span class="err-password_confirmation err-msg"></span>
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="button" class="btn-update btn btn-primary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Save Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('employer.layouts.scripts')

    <script>
        $('.btn-update').on('click', function() {
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('current_password', $('#current_password').val());
            formData.append('new_password', $('#new_password').val());
            formData.append('password_confirmation', $('#password_confirmation').val());

            $.ajax({
                url: '{{ route('employer.updatePassword') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                        toastr.success('Password change successfully', 'Success')
                  
                        setTimeout(function() {
                            window.location.href = '{{url('/employer/change-password')}}'
                        }, 2000)
                    } else {
                        displayErrors(JSON.parse(response.errors));
                        let password_errors = validatePassword($('#new_password').val())
                        let html  = ''
                        $.each(password_errors, function(index,error) {
                            html += `<p class="mb-1">${error}</p>`
                        })
                        $('.err-new_password').addClass('d-block').html(html)
                    }
                },
                error: function(xhr, status, error) {
                    var result = JSON.parse(xhr.responseText)
                    displayErrors(result.errors)
                    let password_errors = validatePassword($('#new_password').val())
                        let html  = ''
                        $.each(password_errors, function(index,error) {
                            html += `<p class="mb-1">${error}</p>`
                        })
                        $('.err-new_password').addClass('d-block').html(html)
                }
            });
        })
    </script>
@endsection
