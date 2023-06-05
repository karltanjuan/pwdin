<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>PWDIn - Admin Reset Password</title>

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
						<h2>Reset Password</h2>
							<p>
								<label>New Password<span>*</span></label>
								<input type="password" class="password" id="password" placeholder="Enter password" required>
							</p>
							<p>
								<label>Confirm Password<span>*</span></label>
								<input type="password" class="password_confirmation" id="password_confirmation" placeholder="Enter password confirmation" required>
							</p>
							<p>
								<input class="btn-reset" type="button" value="Reset" />
							</p>
					</div>
				</div>
			</div>
			<div class="credit">
				<p>PWDIn. All rights reserved &copy; {{date('Y')}}</p>
			</div>
		</div>
		
	</body>
</html>