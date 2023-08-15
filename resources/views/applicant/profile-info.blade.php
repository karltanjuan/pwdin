@extends('applicant.layouts.master')

@section('title', 'Applicant - Profile Info')

@section('content')
    <style>
        .content {
            padding: 0;
        }
    </style>
    <div class="content-0">
        <div class="head-container">
            <h1>Profile Information</h1>
        </div>

        <div class="content">
            <div id="form">
                <div class="form first" id="form-first">
                    <div class="details personal">
                        <div class="fields">
                            @php
                                $user = auth()->user();
                            @endphp
                            <div class="input-field">
                                <label>Profile Picture</label>
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
                                <label>Mobile Number</label>
                                <input id="mobile_no" class="mobile_no" type="number" placeholder="Enter mobile number" value="{{$user->mobile_no}}"/>
                                <span class="err-mobile_no err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Date of Birth</label>
                                <input id="birthdate" class="birthdate" type="date" value="{{$user->birthdate}}"/>
                                <span class="err-birthdate err-msg"></span>
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
                                <label>Gender</label>
                                <select id="gender" class="gender">
                                    <option disabled selected>Select gender</option>
                                    <option value="Male" {{ $user->gender === 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ $user->gender === 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Others" {{ $user->gender === 'Others' ? 'selected' : '' }}>Others</option>
                                    </select>
                                </select>
                                <span class="err-gender err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Education Level</label>
                                <select class="education_level" id="education_level">
                                    <option value="None" {{ $user->education_level === 'None' ? 'selected' : '' }}>None</option>
                                    <option value="Elementary" {{ $user->education_level === 'Elementary' ? 'selected' : '' }}>Elementary</option>
                                    <option value="High School" {{ $user->education_level === 'High School' ? 'selected' : '' }}>High School</option>
                                    <option value="Vocational" {{ $user->education_level === 'Vocational' ? 'selected' : '' }}>Vocational</option>
                                    <option value="Associate's Degree" {{ $user->education_level === "Associate's Degree" ? 'selected' : '' }}>Associate's Degree</option>
                                    <option value="Bachelor's degree" {{ $user->education_level === "Bachelor's Degree" ? 'selected' : '' }}>Bachelor's Degree</option>
                                    <option value="Master's degree" {{ $user->education_level === "Master's Degree" ? 'selected' : '' }}>Master's Degree</option>
                                    <option value="Doctorate" {{ $user->education_level === 'Doctorate' ? 'selected' : '' }}>Doctorate</option>
                                </select>

                                <span class="err-education_level err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Province</label>
                            <select class="province" id="province"></select>
                            <span class="err-province err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>City</label>
                            <select class="city" id="city">
                                {{-- <option selected disabled>Please select</option> --}}
                            </select>
                            <span class="err-city err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Address</label>
                            <input class="adress" id="address" type="text" placeholder="Enter complete address" value="{{$user->address}}">
                            <span class="err-address err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Zip Code</label>
                            <input class="zip_code" id="zip_code" type="text" placeholder="Enter zip code" value="{{$user->zip_code}}">
                            <span class="err-zip_code err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>PWD Categories</label>
                            <select class="pwd_categories" id="pwd_categories" name="pwd_categories[]" multiple="multiple">
                                <option value="All">All</option>
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
                        <div class="input-field"></div>
                    </div>
                    <button class="primary-btn btn-update">Save Profile</button>
                </div>
            </div>

            </div>
        </div>



        <script>

            $(document).ready(function() {
                getProvinces()
                $('.pwd_categories').select2();

                var pwd_categories = `{{auth()->user()->pwd_categories}}`;
                $('.pwd_categories').val(pwd_categories.split(",").map(item => item.trim()))
                $('.pwd_categories').trigger('change');

                $('.province').val('{{auth()->user()->province}}')
                setTimeout(function() {
                    province_code = $('.province>option:selected').data('key')
                    console.log(province_code)
                    getCities(province_code)
                }, 500)
            })

            function getProvinces() {
                fetch('{{asset('/json/provinces.json')}}')
                .then(response => response.json()) 
                .then(data => {
                    var html = "";
                    var selected = "";
                    $.each(data, function(index, item) {

                        // var selected = (index === 0) ? "selected" : "";
                        var selected = ""
                        if (item.name == '{{auth()->user()->province}}') {
                            selected = 'selected'
                        }

                        html += `<option ${selected} value="${item.name}" data-key="${item.key}">${item.name}</option>`
                    });

                    $('.province').html(html);

                    province_code = $('.province>option:first:selected').data('key')
                    getCities(province_code)
                })
                .catch(error => {
                    console.log('Error:', error);
                });
            }

            $('.province').on('change', function() {
                province_code = $(this).find('option:selected').data('key') // data-key attribute

                getCities(province_code)
            })

            function getCities(province_code) {
                // only select city by province code
                fetch('{{asset('/json/cities.json')}}')
                .then(response => response.json()) 
                .then(data => {
                    // compare province_code with city.province then return matching results
                    var filtered_cities = $(data).filter((index, city) => city.province === province_code).toArray();

                    var html = "";
                    $.each(filtered_cities, function(index, item) {
                        var selected = ""
                        if (item.name == '{{auth()->user()->city}}') {
                            selected = "selected"
                        }
                        html += `<option ${selected} value="${item.name}">${item.name}</option>`
                    });

                    $('.city').html(html);
                })
                .catch(error => {
                    console.log('Error:', error);
                });
            }

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
                formData.append('old_file', '{{auth()->user()->profile_photo}}');
                formData.append('profile_photo', $('#profile_photo')[0].files[0]);
                formData.append('username', $('#username').val());
                formData.append('email', $('#email').val());
                formData.append('mobile_no', $('#mobile_no').val());
                formData.append('birthdate', $('#birthdate').val());
                formData.append('first_name', $('#first_name').val());
                formData.append('middle_name', $('#middle_name').val());
                formData.append('last_name', $('#last_name').val());
                formData.append('prefix', $('#prefix').val());
                formData.append('gender', $('#gender').val());
                formData.append('education_level', $('#education_level').val());
                formData.append('province', $('#province').val());
                formData.append('city', $('#city').val());
                formData.append('address', $('#address').val());
                formData.append('zip_code', $('#zip_code').val());
                formData.append('pwd_categories', $('#pwd_categories').val().join());

                $.ajax({
                    url: '{{ route('applicant.updateProfileInfo') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.code == "200") {
                            Swal.fire({
                              title: 'Profile information updated successfully',
                              text: '',
                              icon: 'success',
                              showCancelButton: false,
                              confirmButtonText: 'OK'
                            });
                            
                            setTimeout(function() {
                                    window.location.href = '{{url('/applicant/profile-info')}}'
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