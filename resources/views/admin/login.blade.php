<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>PWDIn - Admin Login</title>

		<link rel="stylesheet" href="{{asset('css/admin.css')}}">
	</head>
	<body>
		<div class="wrapper">
			<div class="container">
				<div class="col-left">
					<div class="login-text">
						<h2>Administrator</h2>
						<img class="pwdin-logo" src="{{asset('img/logo.png')}}" alt="PWDIn Logo">
					</div>
				</div>
				<div class="col-right">
					<div class="login-form">
						<h2>Login</h2>
							<p>
								<label>Username<span>*</span></label>
								<input type="text" class="username" id="username" placeholder="Enter username">
								<span class="err-username err-msg"></span>
							</p>
							<p>
								<label>Password<span>*</span></label>
								<input type="password" class="password" id="password" placeholder="Enter password">
								<span class="err-password err-msg"></span>
							</p>
							<p>
								<input class="btn-login" type="button" value="Log In" />
							</p>
							<p>
								<a href="{{url('admin/forgot-password')}}">Forgot Password?</a>
							</p>
					</div>
				</div>
			</div>
			<div class="credit">
				<p>PWDIn. All rights reserved &copy; {{date('Y')}}</p>
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
			formData.append('username', $('#username').val());
			formData.append('password', $('#password').val());

	        // Send an AJAX request to validate the data
	        $.ajax({
	            url: '{{ route('admin.postLogin') }}',
	            type: 'POST',
	            data: formData,
	            processData: false,
	            contentType: false,
	            success: function(response) {
	                if (response.code == "200") {
                        
                        $('input').removeClass('error')
                        $('.err-msg').hide()

	                	Swal.fire({
						  title: 'Login Successful',
						  text: 'Please wait...',
						  icon: 'success',
						  showCancelButton: false,
						  confirmButtonText: 'OK'
						})

						setTimeout(function() {
                            window.location.href = '{{url('/admin/dashboard')}}'
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