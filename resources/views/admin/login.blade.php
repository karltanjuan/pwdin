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

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid bg-white p-0">

        <section class="vh-100">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">
                        <img src="{{ url('/img/admin_login.jpg') }}" class="img-fluid" alt="Sample image">
                        </p>
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <h1>Admin Login</h1>
                        <div class="divider d-flex align-items-center my-4">
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4 form-floating">
                            <input type="email" id="email" class="form-control form-control-lg email"
                                placeholder="Enter email address" />
                            <label class="form-label" for="email">Email address</label>
                            <span class="err-email err-msg"></span>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3 form-floating">
                            <input type="password" id="password" class="form-control form-control-lg password"
                                placeholder="Enter password" />
                            <label class="form-label" for="password">Password</label>
                            <span class="show eye-icon-position">
                                <i class="las la-eye fs-5" id="show3" onclick="toggle3()"></i>
                            </span>
                            <span class="err-password err-msg"></span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ url('admin/forgot-password') }}" class="text-body">Forgot
                                password?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="button" class="btn-login btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-center">&copy; {{ env('APP_NAME') }}. All Rights Reserved {{ date('Y') }}</p>
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
        let click_counter = 0;

        $('.btn-login').on('click', function() {
            $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`);

            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('email', $('#email').val());
            formData.append('password', $('#password').val());

            if (click_counter === 0) {
                click_counter++;
                $(this).prop('disabled', true);

                $.ajax({
                    url: '{{ route('admin.postLogin') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.code == "200") {
                            $('.btn-login').html(`Login`);
                            $('input').removeClass('error')
                            $('.err-msg').hide()

                            toastr.success('Redirecting to dashboard...', 'Login Successful');

                            setTimeout(function() {
                                window.location.href =
                                    '{{ url('/admin/dashboard') }}'
                            }, 2000)
                        } else {
                            displayErrors(JSON.parse(response.errors));
                            let password_errors = validatePassword($('#password').val())
                            let html  = ''
                            $.each(password_errors, function(index,error) {
                                html += `<p class="mb-1">${error}</p>`
                            })
                            $('.err-password').addClass('d-block').html(html)
                            $('.btn-login').html(`Login`).prop('disabled', false);
                            click_counter = 0;
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle the AJAX request error
                        var result = JSON.parse(xhr.responseText)
                        displayErrors(result.errors)
                        let password_errors = validatePassword($('#password').val())
                        let html  = ''
                        $.each(password_errors, function(index,error) {
                            html += `<p class="mb-1">${error}</p>`
                        })
                        $('.err-password').addClass('d-block').html(html)
                        $('.btn-login').html(`Login`).prop('disabled', false);
                        click_counter = 0;
                    }
                });
            }

        })
    </script>

</body>

</html>
