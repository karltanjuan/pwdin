@extends('applicant.layouts.master')

@section('title', 'Applicant - Profile Information')
@section('cover_page')
    <li class="breadcrumb-item text-white active">Settings</li>
    <li class="breadcrumb-item text-white active">Profile Information</li>
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>

    <style>
        .select2-selection {
            min-height: 58px !important;
        }
    </style>
    
    @php $user = auth()->user() @endphp

    <h1 class="text-center mb-5 wow fadeInUp title-label" data-wow-delay="0.1s">Profile Information</h1>

    <div class="row wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
                @php
                    $profile_photo = str_replace('public', 'storage', auth()->user()->profile_photo);
                @endphp

                @if(!empty($profile_photo))
                    <img src="{{asset($profile_photo)}}" alt="avatar" class="rounded-circle img-fluid img-preview" style="width: 150px;height:150px;">
                @else
                    <img src="{{asset('/img/default_avatar.png')}}" alt="avatar" class="rounded-circle img-fluid img-preview" style="width: 150px;height:150px;">
                @endif

                <h5 class="my-3">{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}</h5>
                {{-- <p class="text-muted mb-1">Full Stack Developer</p> --}}
                <p class="text-muted mb-4">{{$user->city}}, {{$user->province}}</p>

                <div class="input-group">
                    <input type="file" class="form-control form-control-md profile_photo" id="profile_photo" tabindex="18"
                        accept=".jpg,.jpeg,.png">
                    <label class="input-group-text" for="profile_photo">Profile Photo</label>
                </div>
                <span class="err-profile_photo err-msg mb-4"></span>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="text" id="username" class="form-control form-control-lg username"
                            placeholder="Enter username" tabindex="1" value="{{$user->username}}"/>
                        <label class="form-label" for="username">Username</label>
                        <span class="err-username err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="email" id="email" class="form-control form-control-lg email"
                            placeholder="Enter email address" tabindex="2" value="{{$user->email}}"/>
                        <label class="form-label" for="email">Email Address</label>
                        <span class="err-email err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="number" id="mobile_no" class="form-control form-control-lg mobile_no"
                            placeholder="Enter mobile number" tabindex="3" value="{{$user->mobile_no}}"/>
                        <label class="form-label" for="mobile_no">Mobile Number</label>
                        <span class="err-mobile_no err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="date" id="birthdate" class="form-control form-control-lg birthdate" tabindex="4" value="{{$user->birthdate}}"/>
                        <label class="form-label" for="birthdate">Date of Birth</label>
                        <span class="err-birthdate err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="text" id="first_name" class="form-control form-control-lg first_name"
                            placeholder="Enter first name" tabindex="5" value="{{$user->first_name}}"/>
                        <label class="form-label" for="first_name">First Name</label>
                        <span class="err-first_name err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="text" id="middle_name" class="form-control form-control-lg middle_name"
                            placeholder="Enter middle name" tabindex="6" value="{{$user->middle_name}}"/>
                        <label class="form-label" for="middle_name">Middle Name</label>
                        <span class="err-middle_name err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="text" id="last_name" class="form-control form-control-lg last_name"
                            placeholder="Enter last name" tabindex="7" value="{{$user->last_name}}"/>
                        <label class="form-label" for="last_name">Last Name</label>
                        <span class="err-last_name err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="text" id="prefix" class="form-control form-control-lg prefix"
                            placeholder="Enter prefix" tabindex="8" value="{{$user->prefix}}"/>
                        <label class="form-label" for="prefix">Prefix</label>
                        <span class="err-prefix err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-4">
                        <select class="gender form-select" id="gender" tabindex="9">
                            <option value="Male" {{ $user->gender === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $user->gender === 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Others" {{ $user->gender === 'Others' ? 'selected' : '' }}>Others</option>
                        </select>
                        <label for="gender">Gender</label>
                        <span class="err-gender err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-4">
                        <select class="education_level form-select" id="education_level" tabindex="10">
                            <option value="None" {{ $user->education_level === 'None' ? 'selected' : '' }}>None</option>
                            <option value="Elementary" {{ $user->education_level === 'Elementary' ? 'selected' : '' }}>Elementary</option>
                            <option value="High School" {{ $user->education_level === 'High School' ? 'selected' : '' }}>High School</option>
                            <option value="Vocational" {{ $user->education_level === 'Vocational' ? 'selected' : '' }}>Vocational</option>
                            <option value="College" {{ $user->education_level === 'College' ? 'selected' : '' }}>College</option>
                            <option value="Associate's Degree" {{ $user->education_level === "Associate's Degree" ? 'selected' : '' }}>Associate's Degree</option>
                            <option value="Bachelor's degree" {{ $user->education_level === "Bachelor's Degree" ? 'selected' : '' }}>Bachelor's Degree</option>
                            <option value="Master's degree" {{ $user->education_level === "Master's Degree" ? 'selected' : '' }}>Master's Degree</option>
                            <option value="Doctorate" {{ $user->education_level === 'Doctorate' ? 'selected' : '' }}>Doctorate</option>
                        </select>
                        <label for="education_level">Education Level</label>
                        <span class="err-education_level err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-4">
                        <select class="province form-select" id="province" tabindex="11"></select>
                        <label for="province">Province</label>
                        <span class="err-province err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-4">
                        <select class="city form-select" id="city" tabindex="12"></select>
                        <label for="city">City</label>
                        <span class="err-city err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="text" id="address" class="form-control form-control-lg address"
                            placeholder="Enter address" tabindex="13" value="{{$user->address}}"/>
                        <label class="form-label" for="address">Address</label>
                        <span class="err-address err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="text" id="zip_code" class="form-control form-control-lg zip_code"
                            placeholder="Enter zip_code" tabindex="14" value="{{$user->zip_code}}"/>
                        <label class="form-label" for="zip_code">Zip Code</label>
                        <span class="err-zip_code err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-4">
                        <select class="pwd_categories form-select" id="pwd_categories" tabindex="15" name="pwd_categories[]" multiple="multiple">
                            <option value="Psychosocial">Psychosocial</option>
                            <option value="Mental">Mental</option>
                            <option value="Physical">Physical</option>
                            <option value="Chronic illness">Chronic illness</option>
                            <option value="Learning">Learning</option>
                            <option value="Visual">Visual</option>
                            <option value="Orthopedic">Orthopedic</option>
                            <option value="Communication">Communication</option>
                        </select>
                        <label for="pwd_categories">PWD Categories</label>
                        <span class="err-pwd_categories err-msg"></span>
                    </div>
                </div>
                <hr>
                <div class="col-md-12">
                    <label class="form-label" for="skills">Skills</label>
                    <input type="text" id="skills" class="form-control form-control-lg skills"
                        placeholder="Enter skills" tabindex="14" value="{{$user->skills}}"/>
                    <span class="err-skills err-msg"></span>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control description" id="description" rows="10" placeholder="Description">{{$user->description}}</textarea>
                        <label for="description">Description</label>
                        <span class="err-description err-msg"></span>
                    </div>
                </div>

                <div class="text-center text-lg-start pt-2">
                    <button type="button" class="btn-update btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Save Profile</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    @include('applicant.layouts.scripts')

    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
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

            const skills = document.querySelector('.skills');
            let choices = new Choices(skills, {
                removeItems: true,
                removeItemButton: true,
            });
        })

        $('.profile_photo').on('change', function(event) {
            const selectedImage = event.target.files[0];
            
            if (selectedImage) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    $('.img-preview').attr('src', e.target.result);
                };
                
                reader.readAsDataURL(selectedImage);
            }
        });

        $(document).on('change', '.pwd_categories', function() {
            if ($(this).val() != '') {
                $('label[for="pwd_categories"]').css('z-index', '-1')
            } else {
                $('label[for="pwd_categories"]').css('z-index', '0')
            }
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
            formData.append('skills', skills.value)
            formData.append('description', $('#description').val())

            $.ajax({
                url: '{{ route('applicant.updateProfileInfo') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                        toastr.success('Profile information updated successfully', 'Success')
            
                        setTimeout(function() {
                                window.location.href = '{{url('/applicant/profile-info')}}'
                            }, 2000)
                    } else {
                        displayErrors(JSON.parse(response.errors));
                    }
                },
                error: function(xhr, status, error) {
                    var result = JSON.parse(xhr.responseText)
                    displayErrors(result.errors)
                }
            });
        })
    </script>
@endsection
