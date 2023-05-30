<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <title>PWDIn Login</title>
</head>
<body>
    <div class="grid-fluid">
        <div class="row">
            <div class="col-tab-12">
                <!-- Navbar -->
                <nav class="navbar">
                    <a href="#">
                        <img src="{{asset('img/logo.png')}}" class="logo"/>
                    </a>
                    <div class="navbar-buttons">
                        <a href="home">Home</a>
                        <a href="job_seeker">Job Seekers</a>
                        <a href="employer">Employers</a>
                        <a href="about_us">About Us</a>
                    </div>
                </nav>
            </div>
        </div>
        <!--main container-->
        <div class="row">
            <div class="col-tab-7">
                <!-- Form -->
                <div class="form-container">
                    <div class="login-container">
                        <p class="welcome">Welcome To</p>
                        <img src="{{asset('img/logo2.png')}}" class="logo2" alt="">
                        <div class="form-group-inputs">
                            <input type="text" id="email" class="email" placeholder="Enter email"/>
                           	<span class="err-email err-msg"></span>
                            <input type="password" id="password" class="password" placeholder="Enter password"/>
                            <span class="err-password err-msg"></span>
                            <a href="javascript:void(0)" class="forgot-pass">Forgot Password</a>
                            <input type="button" class="btn-login" value="Log In">
                        </div>
                    </div>
                    <!--Register container-->
                    <div class="register-container">
                        <img src="{{asset('img/or.png')}}" class="or" alt="or">
                        <p class="welcome">Register As</p>
                        <input type="button" class="register-candidate" value="Candidate">
                        <input type="button" class="register-employer" value="Employer">
                    </div>
                </div>
            </div>
            <div class="col-tab-5">
                <!--Image container-->
                <div class="image-container">
                    <!-- <img src="./asset/img/quote1.png" class="quotes" alt=""> -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
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
		}

		
    	$('.btn-login').on('click', function() {
    		// prepare the data to be submitted on backend
    		var formData = new FormData();
			formData.append('_token', "{{ csrf_token() }}");
			formData.append('email', $('#email').val());
			formData.append('password', $('#password').val());

	        // Send an AJAX request to validate the data
	        $.ajax({
	            url: '{{ route('applicant.postLogin') }}',
	            type: 'POST',
	            data: formData,
	            processData: false,
	            contentType: false,
	            success: function(response) {
	                if (response.code == "200") {
	                	Swal.fire({
						  title: 'Login Successful',
						  text: 'Please wait...',
						  icon: 'success',
						  showCancelButton: false,
						  confirmButtonText: 'OK'
						}).then((result) => {
						  if (result.isConfirmed) {
						  	window.location.href = '{{url('/applicant/dashboard')}}'
						  }
						});
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