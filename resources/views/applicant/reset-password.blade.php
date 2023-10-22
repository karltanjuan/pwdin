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

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
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
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">
                        <img src="{{ url('/img/reset_password2.jpg') }}" class="img-fluid" alt="Reset Password">
                        <p class="text-justify"></p>
                        </p>
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <h1>Reset Password</h1>
                        <div class="divider d-flex align-items-center my-4">
                        </div>
                        
                        <!-- New password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="new_password">New Password</label>
                            <input type="password" id="new_password" class="form-control form-control-lg new_password"
                                placeholder="Enter new password" />
                            <span class="show eye-icon-position">
                                <i class="las la-eye fs-5" id="show1" onclick="toggle1()"></i>
                            </span>
                            <span class="err-new_password err-msg"></span>
                        </div>

                        <!-- Confirm password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <input type="password" id="password_confirmation" class="form-control form-control-lg password_confirmation"
                                placeholder="Enter password confirmation" />
                            <span class="show eye-icon-position">
                                <i class="las la-eye fs-5" id="show2" onclick="toggle2()"></i>
                            </span>
                            <span class="err-password_confirmation err-msg"></span>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="button" class="btn-reset btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Reset</button>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-center">&copy; {{ env('APP_NAME') }}. All Rights Reserved {{ date('Y') }}
        </section>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
            <i class="fa fa-angle-up" aria-hidden="true"></i>
        </a>
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

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
    	$('.btn-reset').on('click', function() {
    		// prepare the data to be submitted on backend
    		var formData = new FormData();
			formData.append('_token', "{{ csrf_token() }}");
			formData.append('reset_token', '{{ app('request')->segment(3) }}');
			formData.append('new_password', $('#new_password').val());
			formData.append('password_confirmation', $('#password_confirmation').val());

	        // Send an AJAX request to validate the data
	        $.ajax({
	            url: '{{ route('applicant.postResetPassword') }}',
	            type: 'POST',
	            data: formData,
	            processData: false,
	            contentType: false,
	            success: function(response) {
	                if (response.code == "200") {
                        
                        $('input').removeClass('error')
                        $('.err-msg').hide()

                        toastr.success('Password reset successfully', 'Redirecting to login...')

						setTimeout(function() {
                            window.location.href = '{{url('/applicant/login')}}'
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

</body>

</html>
