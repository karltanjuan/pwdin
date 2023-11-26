<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PWDIn</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

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
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

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
                <h1 class="m-0 text-primary">PWDIn</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
                    <a href="{{ url('/about-us') }}" class="nav-item nav-link">About</a>
                    <a href="{{ url('/choose-account') }}" class="nav-item nav-link d-md-none">Login Account</a>
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
                    <div class="col-md-12">
                        <h1>Applicant Registration</h1>
                        <div class="divider d-flex align-items-center my-4"></div>
                        <h3>Personal Details</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Username input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="text" id="username" class="form-control form-control-lg username"
                                        placeholder="Enter username" tabindex="1" />
                                    <label class="form-label" for="username">Username (Required)</label>
                                    <span class="err-username err-msg"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Email input -->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="email" id="email" class="form-control form-control-lg email"
                                        placeholder="Enter email address" tabindex="2" />
                                    <label class="form-label" for="email">Email address (Required)</label>
                                    <span class="err-email err-msg"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Mobile number input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="text" id="mobile_no"
                                        class="form-control form-control-lg mobile_no"
                                        placeholder="Enter mobile number" tabindex="3" maxlength="11"/>
                                    <label class="form-label" for="mobile_no">Mobile Number (Required)</label>
                                    <span class="err-mobile_no err-msg"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Birthdate input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="date" id="birthdate"
                                        class="form-control form-control-lg birthdate"
                                        placeholder="Enter birthdate" tabindex="4"/>
                                    <label class="form-label" for="birthdate">Date of Birth (Required)</label>
                                    <span class="err-birthdate err-msg"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Gender -->
                                <div class="form-floating mb-4">
                                    <select class="gender form-select" id="gender" tabindex="5">
                                         <option disabled selected>Select gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <span class="err-gender err-msg"></span>
                                    <label for="gender">Gender</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Education Level -->
                                <div class="form-floating mb-4">
                                    <select class="form-select education_level" id="education_level" tabindex="6">
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
                            </div>

                            <div class="col-md-4">
                                <!-- First name input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="text" id="first_name"
                                        class="form-control form-control-lg first_name"
                                        placeholder="Enter first name" tabindex="7"/>
                                    <label class="form-label" for="first_name">First Name (Required)</label>
                                    <span class="err-first_name err-msg"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Middle name input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="text" id="middle_name"
                                        class="form-control form-control-lg middle_name"
                                        placeholder="Enter middle name" tabindex="8"/>
                                    <label class="form-label" for="middle_name">Middle Name</label>
                                    <span class="err-middle_name err-msg"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Last name input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="text" id="last_name"
                                        class="form-control form-control-lg last_name"
                                        placeholder="Enter last name" tabindex="9"/>
                                    <label class="form-label" for="last_name">Last Name (Required)</label>
                                    <span class="err-last_name err-msg"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                    <!-- Prefix input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="text" id="prefix" class="form-control form-control-lg prefix"
                                        placeholder="Enter prefix" tabindex="10"/>
                                    <label class="form-label" for="prefix">Prefix</label>
                                    <span class="err-prefix err-msg"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Province -->
                                <div class="form-floating mb-4">
                                    <select class="province form-select" id="province" tabindex="11"></select>
                                    <span class="err-province err-msg"></span>
                                    <label for="province">Province</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- City -->
                                <div class="form-floating mb-4">
                                    <select class="city form-select" id="city"tabindex="12"></select>
                                    <span class="err-city err-msg"></span>
                                    <label for="city">City</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Zip code input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="text" id="zip_code"
                                        class="form-control form-control-lg zip_code" placeholder="Enter zip code" tabindex="13"/>
                                    <label class="form-label" for="zip_code">Zip Code (Required)</label>
                                    <span class="err-zip_code err-msg"></span>
                                </div>
                            </div>
                                
                            
                            <div class="col-md-4">
                                <!-- Address input-->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="text" id="address" class="form-control form-control-lg address"
                                        placeholder="Enter address" tabindex="14"/>
                                    <label class="form-label" for="address">Address (Required)</label>
                                    <span class="err-address err-msg"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- PWD Categories -->
                                <div class="form-outline mb-4 form-floating">
                                    <select class="pwd_categories form-select form-control form-control-lg" tabindex="15"
                                        id="pwd_categories" name="pwd_categories[]" multiple="multiple">
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
                                    <span class="err-pwd_categories err-msg"></span>
                                    <label for="pwd_categories">PWD Categories (Required)</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Password input -->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="password" id="password" class="form-control form-control-lg password"
                                        placeholder="Enter password" tabindex="16"/>
                                    <label class="form-label" for="password">Password (Required)</label>
                                    <span class="show eye-icon-position">
                                        <i class="las la-eye fs-5" id="show3" onclick="toggle3()"></i>
                                    </span>
                                    <span class="err-password err-msg"></span>
                                    {{-- <span><i>Password must be atleast 8 characters including alpha numeric and special character.</i></span> --}}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Confirm password input -->
                                <div class="form-outline mb-4 form-floating">
                                    <input type="password" id="password_confirmation"
                                        class="form-control form-control-lg password_confirmation"
                                        placeholder="Enter password confirmation" tabindex="17"/>
                                    <label class="form-label" for="password_confirmation">Confirm Password (Required)</label>
                                    <span class="show eye-icon-position">
                                        <i class="las la-eye fs-5" id="show3" onclick="toggle2()"></i>
                                    </span>
                                    <span class="err-password_confirmation err-msg"></span>
                                </div>
                            </div>
                        </div>

                        <div class="divider d-flex align-items-center my-4"></div>
                        <h3>Identity Details</h3>

                        <div class="row">
                            <div class="col-md-12">
                            <label class="text-danger">Required</label>
                                <div class="input-group">
                                    <input type="file" class="form-control form-control-lg resume" id="resume" tabindex="18"
                                        accept=".pdf">
                                    <label class="input-group-text" for="resume">Upload Resume</label>
                                </div>
                                <span class="err-resume err-msg mb-4"></span>
                            </div>
                            <div class="col-md-12">
                            <label class="text-danger">Required</label>
                                <div class="input-group ">
                                    <input type="file" class="form-control form-control-lg pwd_card"
                                        id="pwd_card" accept=".png,.jpeg,.jpg" tabindex="19">
                                    <label class="input-group-text" for="pwd_card">Upload PWD ID card</label>
                                </div>
                                <span class="err-pwd_card err-msg mb-4"></span>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="file" class="form-control form-control-lg profile_photo" tabindex="20"
                                        id="profile_photo" accept=".png,.jpeg,.jpg">
                                    <label class="input-group-text" for="profile_photo">Upload Profile Picture</label>
                                </div>
                                <span class="err-profile_photo err-msg mb-4"></span>
                            </div>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input accept-agreement" id="accept-agreement" type="checkbox">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#agreement-modal" tabindex="21"
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
                                style="padding-left: 2.5rem; padding-right: 2.5rem;" tabindex="22">Register</button>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terms and Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div><i>These terms and conditions ("Terms") govern your use of the PWDIn website and the services provided through it. By creating an account on PWDIn, you agree to abide by these Terms. Please read them carefully.</i></div><br>

                        <p><b>1. Eligibility</b></p>
                        <p>1.1. You must be at least 18 years of age to create an account on PWDIn.</p>
                        <p>1.2. By creating an account, you represent that you have the legal capacity to enter into these Terms and are not prohibited by any applicable law from using our services.</p>
                        <p><b>2. Account Registration</b></p>

                        <p>2.1. To create an account, you will be required to provide accurate, current, and complete information as requested during the registration process.</p>

                        <p>2.2. You are responsible for maintaining the confidentiality of your account information, including your username and password.</p>

                        <p>2.3. You agree to notify us immediately of any unauthorized use of your account.</p>

                        <p><b>3. User Conduct</b></p>

                        <p>3.1. You agree to use PWDIn for lawful purposes and in a manner consistent with all applicable local, state, and federal laws and regulations.</p>

                        <p>3.2. You agree not to:
                            a. Engage in any fraudulent, abusive, or unethical activity on the platform.
                            b. Impersonate any person or entity.
                            c. Upload, post, or transmit any content that violates intellectual property rights, privacy, or other rights of others.
                            d. Use the platform to distribute spam, malware, or any other malicious content.
                            website.</p>

                        <p><b>4. Privacy</b></p>

                        <p>4.1. Your use of PWDIn is also governed by our Privacy Policy, which can be found on our website.</p>

                        <p><b>5. Termination</b></p>

                        <p>5.1. We reserve the right to terminate or suspend your account at our discretion if we believe you have violated these Terms or any applicable laws.</p>

                        <p><b>6. Modifications</b></p>

                        <p>6.1. We may update or modify these Terms from time to time, and you will be notified of such changes.</p>

                        <p><b>7. Contact Information</b></p>

                        <p>7.1. If you have any questions or concerns regarding these Terms, you can contact us at [Contact Email Address].</p>

                        <p><b>8. Entire Agreement</b></p>

                        <p>8.1. These Terms, together with our Privacy Policy, constitute the entire agreement between you and PWDIn.</p>
                        
                        <p>By creating an account on PWDIn, you acknowledge that you have read, understood, and agreed to these Terms and the associated Privacy Policy.</p>
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
    <!-- <script src="https://cdn.userway.org/widget.js" data-account="HaifC5drHg"></script> -->

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        $(document).ready(function() {
            getProvinces()
            $('.pwd_categories').select2();
        })

        $(document).on('change', '.pwd_categories', function() {
            if ($(this).val() != '') {
                $('label[for="pwd_categories"]').css('z-index', '-1')
            } else {
                $('label[for="pwd_categories"]').css('z-index', '0')
            }
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

                    var html = '<option value="">Select Province</option>';
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


                    var html = '<option value="">Select City</option>';
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

        var click_counter = 0;

        $('.btn-register').on('click', function() {
            $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`);
        $('.email').on('keypress', function() {
            registerUser();
        })

        $('.username').on('keypress', function() {
            registerUser();
        })

        $('.mobile_no').on('keypress', function(event) {
            registerUser();
            var keyCode = event.which;
            // Check if the key is a digit (0-9)
            if (keyCode < 48 || keyCode > 57) {
                // Prevent the default action if the key is not a digit
                event.preventDefault();
            }
        })

        $('.password').on('keypress', function() {
            registerUser();
        })

        $('.password_confirmation').on('keypress', function() {
            registerUser();
        })

        $('.birthdate').on('keypress', function() {
            registerUser();
        })

        $('.first_name').on('keypress', function() {
            registerUser();
        })

        $('.middle_name').on('keypress', function() {
            registerUser();
        })

        $('.last_name').on('keypress', function() {
            registerUser();
        })

        $('.prefix').on('keypress', function() {
            registerUser();
        })

        $('.gender').on('keypress', function() {
            registerUser();
        })

        $('.education_level').on('keypress', function() {
            registerUser();
        })

        $('.province').on('keypress', function() {
            registerUser();
        })

        $('.city').on('keypress', function() {
            registerUser();
        })

        $('.address').on('keypress', function() {
            registerUser();
        })

        $('.zip_code').on('keypress', function() {
            registerUser();
        })

        $('.pwd_categories').on('keypress', function() {
            registerUser();
        })

        $('.profile_photo').on('keypress', function() {
            registerUser();
        })

        $('.resume').on('keypress', function() {
            registerUser();
        })

        $('.pwd_card').on('keypress', function() {
            registerUser();
        })

        $('.btn-register').on('click', function() {
            registerUser();
        })

        

        function registerUser() {
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

                if (click_counter === 0) {
                    click_counter++;
                    $(this).prop('disabled', true);

                    $.ajax({
                        url: '{{ route('applicant.postRegister') }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.code == "200") {
                                $('.btn-register').html('Register')

                                toastr.info('Registration Pending',
                                    'Please anticipate a verification process for your account that may take up to three days.'
                                )

                                setTimeout(function() {
                                    window.location.href = '{{ url('/') }}'
                                }, 2000)
                            } else {
                                displayErrors(JSON.parse(response.errors));
                                let password_errors = validatePassword($('#password').val())
                                let html  = ''
                                $.each(password_errors, function(index,error) {
                                    html += `<p class="mb-1">${error}</p>`
                                })
                                $('.err-password').addClass('d-block').html(html)
                                $('.btn-register').html('Register').prop('disabled', false);
                                click_counter = 0;
                            }
                        },
                        error: function(xhr, status, error) {
                            var result = JSON.parse(xhr.responseText)
                            displayErrors(result.errors)
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
                            displayErrors(JSON.parse(response.errors));
                            let password_errors = validatePassword($('#password').val())
                            let html  = ''
                            $.each(password_errors, function(index,error) {
                                html += `<p class="mb-1">${error}</p>`
                            })
                            $('.err-password').addClass('d-block').html(html)
                            $('.btn-register').html('Register').prop('disabled', false);
                            click_counter = 0;
                        }
                    });
                }
            } else {
                $('.err-agreement').show().text('Please read the terms and condition to continue')
                $('.btn-register').html('Register')
            }
        }

        function closeModal() {
            $(".modal").css("display", "none");
        }
    </script>

</body>

</html>
