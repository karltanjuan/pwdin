<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>PWDIn - Employer Forgot Password</title>

		<link rel="stylesheet" href="{{asset('css/admin.css')}}">
	</head>
	<body>
		<div class="wrapper">
			<div class="container">
				<div class="col-left">
					<div class="login-text">
						<h2>Employer</h2>
						<img class="pwdin-logo" src="{{asset('img/logo.png')}}" alt="PWDIn Logo">
					</div>
				</div>
				<div class="col-right">
					<div class="login-form">
						<h2>Forgot Password</h2>
							<p>
								<label>Email Address<span>*</span></label>
								<input type="text" class="email" id="email" placeholder="Enter email address" required>
								<span class="err-email err-msg"></span>
							</p>
							<p>
								<input class="btn-send" type="button" value="Send" />
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

		
    	$('.btn-send').on('click', function() {
    		// prepare the data to be submitted on backend
    		var formData = new FormData();
			formData.append('_token', "{{ csrf_token() }}");
			formData.append('email', $('#email').val());

	        // Send an AJAX request to validate the data
	        $.ajax({
	            url: '{{ route('employer.postForgotPassword') }}',
	            type: 'POST',
	            data: formData,
	            processData: false,
	            contentType: false,
	            success: function(response) {
	                if (response.code == "200") {
                        
                        $('input').removeClass('error')
                        $('.err-msg').hide()

	                	Swal.fire({
						  title: 'Reset password sent to email',
						  text: 'Check your email inbox',
						  icon: 'info',
						  showCancelButton: false,
						  confirmButtonText: 'OK'
						})

						setTimeout(function() {
                            window.location.href = '{{url('/employer/login')}}'
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