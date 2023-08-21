@extends('admin.layouts.master')

@section('title', 'Admin - Info')

@section('content')
    <style>
        .content {
            padding: 0;
        }

        .summary {
            outline: none;
            font-size: 14px;
            font-weight: 400;
            color: #333;
            border-radius: 5px;
            border: 1px solid #aaa;
            padding: 0 15px;
            height: 42px;
            margin: 8px 0;
        }
    </style>
    <div class="content-0">
        <div class="head-container">
            <h1>Company Information</h1>
            @php
                $user = auth()->guard('admins')->user();
            @endphp
        </div>

        <div class="content">
            @if (auth()->guard('admins')->user()->profile_photo != null)
                @php
                $profile_photo = str_replace('public', 'storage', auth()->guard('admins')->user()->profile_photo);
                @endphp
                <img class="company-logo-info" src="{{asset($profile_photo)}}" alt="Company Logo">
            @else
                <img class="company-logo-info" src="{{asset($profile_photo)}}" alt="Company Logo">
            @endif
            <div id="form">
                <div class="form first" id="form-first">
                    <div class="details personal">
                        <div class="fields">
                            <div class="input-field">
                                <label>Profile Photo</label>
                                <input class="profile_photo" id="profile_photo" type="file" accept=".png,.jpeg,.jpg">
                                <span class="err-profile_photo err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Username</label>
                                <input id="username" class="username" type="text" placeholder="Enter username" value="{{$user->username}}"/>
                                <span class="err-username err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Email Address</label>
                                <input id="email" class="email" type="text" placeholder="Enter email address" value="{{$user->email}}"/>
                                <span class="err-email err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>First Name</label>
                                <input id="first_name" class="first_name" type="text" placeholder="Enter first name" value="{{$user->first_name}}"/>
                                <span class="err-first_name err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Middle Name</label>
                                <input id="middle_name" class="middle_name" type="text" placeholder="Enter middle name" value="{{$user->middle_name}}"/>
                                <span class="err-middle_name err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Last Name</label>
                                <input id="last_name" class="last_name" type="text" placeholder="Enter last name" value="{{$user->last_name}}"/>
                                <span class="err-last_name err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Prefix</label>
                                <input id="prefix" class="prefix" type="text" placeholder="Enter prefix" value="{{$user->prefix}}"/>
                                <span class="err-prefix err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Mobile Number</label>
                                <input id="mobile_no" class="mobile_no" type="number" placeholder="Enter mobile number" value="{{$user->mobile_no}}"/>
                                <span class="err-mobile_no err-msg"></span>
                            </div>
                            <div class="input-field"></div>
                        </div>

                        <button class="primary-btn btn-update">Save Admin</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <script>

            $(document).ready(function() {
            })

            var err_counter = 0;
            function displayErrors(errors) {
                $('.err-msg').text('');
                // $('.error').css('border', 'none')
                $('.err-msg').siblings('input, select').removeClass('error');

                $.each(errors, function(field, messages) {
                    var errMsgSelector = '.err-' + field;
                    var inputSelector = '#' + field;
                    $(errMsgSelector).text(messages[0]);
                    $(inputSelector).addClass('error');
                });

                $("html, body").animate({ scrollTop: 0 }, "slow");
            }

            $('.btn-update').on('click', function() {
                var formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('old_file', '{{auth()->guard('admins')->user()->profile_photo}}');
                formData.append('profile_photo', $('#profile_photo')[0].files[0]);
                formData.append('username', $('#username').val());
                formData.append('email', $('#email').val());
                formData.append('mobile_no', $('#mobile_no').val());
                formData.append('first_name', $('#first_name').val());
                formData.append('middle_name', $('#middle_name').val());
                formData.append('last_name', $('#last_name').val());
                formData.append('prefix', $('#prefix').val());

                $.ajax({
                    url: '{{ route('admin.updateAdminInfo') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.code == "200") {
                            Swal.fire({
                              title: 'Admin information updated successfully',
                              text: '',
                              icon: 'success',
                              showCancelButton: false,
                              confirmButtonText: 'OK'
                            });
                            
                            setTimeout(function() {
                                    window.location.href = '{{url('/admin/profile-info')}}'
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