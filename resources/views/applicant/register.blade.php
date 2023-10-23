<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>pwdIn</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    {{-- <link href="img/favicon.ico" rel="icon"> --}}

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet"> --}}

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"
        integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">

    <style>
        .eye-icon-position,
        .eye-icon-position2 {
            /* position: absolute; */
            /* margin-left: 270px; */
            margin-top: -40px;
        }

        .select2-container--default .select2-selection--multiple {
            padding-bottom: 32px;
        }

        a {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container-fluid bg-white p-0">

        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="/" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <img class="img-fluid w-10 rounded pwdin-logo" src="{{ asset('img/pwdin_logo.png') }}" alt="pwdIn Logo">
                <span>&nbsp;</span>
                <h1 class="m-0 text-primary">pwdIn</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
                    <a href="{{ url('/about') }}" class="nav-item nav-link">About</a>
                    <a href="{{ url('/contact') }}" class="nav-item nav-link">Contact</a>
                </div>
                <a href="{{ url('/choose-account') }}"
                    class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Login Account<i
                        class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->

        <section class="vh-100">
            <div class="container h-custom">
                <div class="row d-flex justify-content-center h-100 mt-5">
                    {{-- <div class="col-md-4">
                        <img src="{{ url('/img/register2.jpg') }}" class="img-fluid register-img" alt="Register"/>
                        <p style="text-align:justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit nulla
                            dicta ipsa ipsam delectus
                            dolorum harum provident vel architecto, molestiae earum perferendis praesentium,
                            consequuntur
                            perspiciatis minima in assumenda qui odio!</p>
                        </p>
                    </div> --}}
                    <div class="col-md-12">
                        <h1>Applicant Registration</h1>
                        <div class="divider d-flex align-items-center my-4"></div>
                        <h3>Personal Details</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Usename input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="text" id="username" class="form-control form-control-lg username"
                                        placeholder="Enter username" tab-index="1" />
                                    <label class="form-label" for="username">Username</label>
                                    <span class="err-username err-msg"></span>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="password" id="password" class="form-control form-control-lg password"
                                        placeholder="Enter password" />
                                    <label class="form-label" for="password">Password</label>
                                    <span class="show eye-icon-position">
                                        <i class="las la-eye fs-5" id="show3" onclick="toggle3()"></i>
                                    </span>
                                    <span class="err-password err-msg"></span>
                                </div>

                                <!-- First name input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="text" id="first_name"
                                        class="form-control form-control-lg first_name"
                                        placeholder="Enter first name" />
                                    <label class="form-label" for="first_name">First Name</label>
                                    <span class="err-first_name err-msg"></span>
                                </div>

                                <!-- Prefix input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="text" id="prefix" class="form-control form-control-lg prefix"
                                        placeholder="Enter prefix" />
                                    <label class="form-label" for="prefix">Prefix</label>
                                    <span class="err-prefix err-msg"></span>
                                </div>

                                <!-- Province -->
                                <div class="form-floating mb-4">
                                    <select class="province form-select" id="province"></select>
                                    <span class="err-province err-msg"></span>
                                    <label for="province">Province</label>
                                </div>

                                <!-- Zip code input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="text" id="zip_code"
                                        class="form-control form-control-lg zip_code" placeholder="Enter zip code" />
                                    <label class="form-label" for="zip_code">Zip Code</label>
                                    <span class="err-zip_code err-msg"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Email input -->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="email" id="email" class="form-control form-control-lg email"
                                        placeholder="Enter email address" tab-index="2" />
                                    <label class="form-label" for="email">Email address</label>
                                    <span class="err-email err-msg"></span>
                                </div>

                                <!-- Confirm password input -->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="password" id="password_confirmation"
                                        class="form-control form-control-lg password_confirmation"
                                        placeholder="Enter password confirmation" />
                                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                                    <span class="show eye-icon-position">
                                        <i class="las la-eye fs-5" id="show3" onclick="toggle2()"></i>
                                    </span>
                                    <span class="err-password_confirmation err-msg"></span>
                                </div>

                                <!-- Middle name input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="text" id="middle_name"
                                        class="form-control form-control-lg middle_name"
                                        placeholder="Enter middle name" />
                                    <label class="form-label" for="middle_name">Middle Name</label>
                                    <span class="err-middle_name err-msg"></span>
                                </div>

                                <!-- Gender -->
                                <div class="form-floating mb-4">
                                    <select class="gender form-select" id="gender">
                                        {{-- <option disabled selected>Select gender</option> --}}
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <span class="err-gender err-msg"></span>
                                    <label for="gender">Gender</label>
                                </div>

                                <!-- City -->
                                <div class="form-floating mb-4">
                                    <select class="city form-select" id="city"></select>
                                    <span class="err-city err-msg"></span>
                                    <label for="city">City</label>
                                </div>

                                <!-- PWD Categories -->
                                <div class="form-outline mb-4 form-floating">
                                    <select class="pwd_categories form-select form-control form-control-lg"
                                        id="pwd_categories" name="pwd_categories[]" multiple="multiple">
                                        <option value="Psychosocial">Psychosocial</option>
                                        <option value="Mental">Mental</option>
                                        <option value="Chronic illness">Chronic illness</option>
                                        <option value="Learning">Learning</option>
                                        <option value="Visual">Visual</option>
                                        <option value="Orthopedic">Orthopedic</option>
                                        <option value="Communication">Communication</option>
                                    </select>
                                    <span class="err-pwd_categories err-msg"></span>
                                    <label for="pwd_categories">PWD Categories</label>
                                </div>


                            </div>

                            <div class="col-md-4">
                                <!-- Mobile number input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="number" id="mobile_no"
                                        class="form-control form-control-lg mobile_no"
                                        placeholder="Enter mobile number" tab-index="3" />
                                    <label class="form-label" for="mobile_no">Mobile Number</label>
                                    <span class="err-mobile_no err-msg"></span>
                                </div>

                                <!-- Birthdate input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="date" id="birthdate"
                                        class="form-control form-control-lg birthdate"
                                        placeholder="Enter birthdate" />
                                    <label class="form-label" for="birthdate">Date of Birth</label>
                                    <span class="err-birthdate err-msg"></span>
                                </div>

                                <!-- Last name input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="text" id="last_name"
                                        class="form-control form-control-lg last_name"
                                        placeholder="Enter last name" />
                                    <label class="form-label" for="last_name">Last Name</label>
                                    <span class="err-last_name err-msg"></span>
                                </div>

                                <!-- Education Level -->
                                <div class="form-floating mb-4">
                                    <select class="form-select education_level" id="education_level">
                                        <option value="None">None</option>
                                        <option value="Elementary">Elementary</option>
                                        <option value="High School">High School</option>
                                        <option value="Vocational">Vocational</option>
                                        <option value="Asociate's degree">Associate's Degree</option>
                                        <option value="Bachelor's degree">Bachelor's Degree</option>
                                        <option value="Master's degree">Master's Degree</option>
                                        <option value="Doctorate">Doctorate</option>
                                    </select>
                                    <span class="err-education_level err-msg"></span>
                                    <label for="education_level">Education Level</label>
                                </div>

                                <!-- Address input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="text" id="address" class="form-control form-control-lg address"
                                        placeholder="Enter address" />
                                    <label class="form-label" for="address">Address</label>
                                    <span class="err-address err-msg"></span>
                                </div>

                            </div>
                        </div>

                        <div class="divider d-flex align-items-center my-4"></div>
                        <h3>Identity Details</h3>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="file" class="form-control form-control-lg resume" id="resume"
                                        accept=".pdf">
                                    <label class="input-group-text" for="resume">Upload CV</label>
                                </div>
                                <span class="err-resume err-msg mb-4"></span>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group ">
                                    <input type="file" class="form-control form-control-lg pwd_card"
                                        id="pwd_card" accept=".png,.jpeg,.jpg">
                                    <label class="input-group-text" for="pwd_card">Upload PWD ID card</label>
                                </div>
                                <span class="err-pwd_card err-msg mb-4"></span>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="file" class="form-control form-control-lg profile_photo"
                                        id="profile_photo" accept=".png,.jpeg,.jpg">
                                    <label class="input-group-text" for="profile_photo">Upload Profile Picture</label>
                                </div>
                                <span class="err-profile_photo err-msg mb-4"></span>
                            </div>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input accept-agreement" id="accept-agreement" type="checkbox">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#agreement-modal"
                                style="cursor:pointer;">
                                <label class="form-check-label" for="accept-agreement">I certify that I have read and
                                    accept to PWDIn’s Terms of Use and Privacy Statement </label>
                            </a>
                            <p class="err-agreement text-danger"></p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <p class="small fw-bold pt-1 mb-0">Already have an account? <a
                                    href="{{ url('/applicant/login') }}" class="link-danger">Login</a></p>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2 mb-5">
                            <button type="button" class="btn-register btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                        </div>
                    </div>
                    <p class="text-center">&copy; {{ env('APP_NAME') }}. All Rights Reserved {{ date('Y') }}</p>
                </div>
            </div>
        </section>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
            <i class="fa fa-angle-up" aria-hidden="true"></i>
        </a>
    </div>

    {{-- Modals --}}

    <div class="modal fade" id="agreement-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="agreementModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terms and Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi vel praesentium expedita quas
                        qui iste sit, iusto hic? Odio, atque possimus quae sunt nostrum, molestiae sed quod maiores
                        impedit ipsa!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-agree btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        $(document).ready(function() {
            getProvinces()
            $('.pwd_categories').select2();
        })

        function getProvinces() {
            fetch('{{ asset('/json/provinces.json') }}')
                .then(response => response.json()) // convert string to json
                .then(data => { // data is the parameter
                    // var html = "<option selected disabled>Please select</option>";
                    var html = "";
                    var selected = "";
                    $.each(data, function(index, item) {
                        var selected = (index === 0) ? "selected" : "";
                        html +=
                            `<option ${selected} value="${item.name}" data-key="${item.key}">${item.name}</option>`
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
            fetch('{{ asset('/json/cities.json') }}')
                .then(response => response.json())
                .then(data => {
                    // compare province_code with city.province then return matching results
                    var filtered_cities = $(data).filter((index, city) => city.province === province_code).toArray();

                    var html = "";
                    $.each(filtered_cities, function(index, item) {
                        html += `<option value="${item.name}">${item.name}</option>`
                    });

                    $('.city').html(html);
                })
                .catch(error => {
                    console.log('Error:', error);
                });
        }

        $(document).on('click', '.btn-agree', function() {
            $('.accept-agreement').prop('checked', true)
            $('.modal').modal('hide')
        })


        $(document).on('click', '.modal-close', function() {
            closeModal()
        })

        $('.btn-register').on('click', function() {

            if ($('#accept-agreement').is(':checked')) {
                $('.err-agreement').hide()
                // prepare the data to be submitted on backend
                var formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}"); // for browser request
                formData.append('username', $('#username').val());
                formData.append('email', $('#email').val());
                formData.append('mobile_no', $('#mobile_no').val());
                formData.append('password', $('#password').val());
                formData.append('password_confirmation', $('#password_confirmation').val());
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
                formData.append('profile_photo', $('#profile_photo')[0].files[0]);
                formData.append('resume', $('#resume')[0].files[0]);
                formData.append('pwd_card', $('#pwd_card')[0].files[0]);

                // Send an AJAX request to validate the data
                $.ajax({
                    url: '{{ route('applicant.postRegister') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.code == "200") {
                            toastr.info('Registration Pending',
                                'Please anticipate a verification process for your account that may take up to three days.'
                            )

                            setTimeout(function() {
                                window.location.href = '{{ url('/') }}'
                            }, 2000)
                        } else {
                            // 422 or another error
                            // JSON.parse converts string to js object
                            displayErrors(JSON.parse(response.errors));
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle the AJAX request error
                        var result = JSON.parse(xhr.responseText)
                        displayErrors(result.errors)
                    }
                });
            } else {
                $('.err-agreement').show().text('Please read the terms and condition to continue')
            }

        })

        function closeModal() {
            $(".modal").css("display", "none");
        }
    </script>

</body>

</html>
