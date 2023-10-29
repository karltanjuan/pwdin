@extends('applicant.layouts.master')

@section('title', 'Applicant Change Password')

@section('content')
    <style>
        .input-field {
            position: relative;
            display: inline-block;
        }

        .eye-icon-position1,
        .eye-icon-position2,
        .eye-icon-position3 {
            position: absolute;
            top: 60%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }   
    </style>
    <div class="content-0">
        <div class="head-container">
            <h1>Change Password</h1>
            <p><b>Note</b>: Strong password should be 8 characters long or more.</p>
        </div> 

        <div id="form">
            <div class="form first" id="form-first">
                <div class="details personal">
                    <div class="fields">
                        <div class="input-field">
                            <label>Current Password</label>
                            <input id="current_password" class="current_password" type="password" placeholder="Enter current password">
                            <span class="show eye-icon-position1">
                                <i class="las la-eye fs-5" id="show1" onclick="toggle1()"></i> 
                            </span>
                        </div>
                        <span class="err-current_password err-msg"></span>
                        <div class="input-field">
                            <label>New Password</label>
                            <input id="new_password" class="new_password" type="password" placeholder="Enter new password">
                            <span class="show eye-icon-position2">
                                <i class="las la-eye fs-5" id="show2" onclick="toggle2()"></i> 
                            </span>
                        </div>
                        <span class="err-new_password err-msg"></span>
                        <div class="input-field">
                            <label>Confirm Password</label>
                            <input id="password_confirmation" class="password_confirmation" type="password" placeholder="Enter password confirmation">
                            <span class="show eye-icon-position3">
                                <i class="las la-eye fs-5" id="show3" onclick="toggle3()"></i> 
                            </span>
                        </div>
                        <span class="err-password_confirmation err-msg"></span>
                    </div>

                    <button class="primary-btn btn-update">Save Password</button>
                    
                </div>
            </div>
        </div>
    </div>

        <script>
            var state1 = false;
            var state2 = false;
            var state3 = false;
            let hide1 = $("#show1");
            let hide2 = $("#show2");
            let hide3 = $("#show3");

            function toggle1() {
              if (state1) {
                $("#current_password").attr("type", "password");
                hide1.css("color", "#D0CECE");
                hide1.removeClass("la-eye-slash").addClass("la-eye");
                state1 = false;
              } else {
                $("#current_password").attr("type", "text");
                hide1.css("color", "#1976D2");
                hide1.removeClass("la-eye").addClass("la-eye-slash");
                state1 = true;
              }
            }

            function toggle2() {
              if (state2) {
                $("#new_password").attr("type", "password");
                hide2.css("color", "#D0CECE");
                hide2.removeClass("la-eye-slash").addClass("la-eye");
                state2 = false;
              } else {
                $("#new_password").attr("type", "text");
                hide2.css("color", "#1976D2");
                hide2.removeClass("la-eye").addClass("la-eye-slash");
                state2 = true;
              }
            }

            function toggle3() {
              if (state3) {
                $("#password_confirmation").attr("type", "password");
                hide3.css("color", "#D0CECE");
                hide3.removeClass("la-eye-slash").addClass("la-eye");
                state3 = false;
              } else {
                $("#password_confirmation").attr("type", "text");
                hide3.css("color", "#1976D2");
                hide3.removeClass("la-eye").addClass("la-eye-slash");
                state3 = true;
              }
            }

            var err_counter = 0;
            function displayErrors(errors) {
                $('.err-msg').text('');
                $('.error').css('border', 'none')
                $('.err-msg').siblings('input, select').removeClass('error');

                $.each(errors, function(field, messages) {
                    var errMsgSelector = '.err-' + field;
                    var inputSelector = '#' + field;
                    $(errMsgSelector).text(messages[0]);
                    $(inputSelector).addClass('error');
                });
            }

        
            $('.btn-update').on('click', function() {
                // prepare the data to be submitted on backend
                var formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('current_password', $('#current_password').val());
                formData.append('new_password', $('#new_password').val());
                formData.append('password_confirmation', $('#password_confirmation').val());

                $.ajax({
                    url: '{{ route('applicant.updatePassword') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.code == "200") {

                            Swal.fire({
                              title: 'Password change successfully',
                              text: '',
                              icon: 'success',
                              showCancelButton: false,
                              confirmButtonText: 'OK'
                            })

                            setTimeout(function() {
                                window.location.href = '{{url('/applicant/change-password')}}'
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