<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Applicant Registration</title>
</head>
<body>
    <!--navbar-->
    <nav class="navbar"> 
    		<a href="{{url('/')}}">
            	<img src="{{asset('img/logo.png')}}" class="logo" alt="PWD 
            Logo"/>
            </a>
        </a> 
        <div class="navbar-buttons">  
            <a href="home">Home</a>
            <a href="job_seeker">Job Seekers</a>
            <a href="employer">Employers</a>
            <a href="about_us">About Us</a>
        </div>
    </nav>
 
    <div class="login-container">
        <header>Applicant Registration</header>

        <div id="form">
            <div class="form first" id="form-first">
                <div class="details personal">
                    <span class="title">Personal Details</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Username</label>
                            <input id="username" class="username" type="text" placeholder="Enter username"/>
                            <span class="err-username err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Email Address</label>
                            <input id="email" class="email" type="text" placeholder="Enter email address"/>
                            <span class="err-email err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Mobile Number</label>
                            <input id="mobile_no" class="mobile_no" type="number" placeholder="Enter mobile number"/>
                            <span class="err-mobile_no err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Password</label>
                            <input id="password" class="password" type="password" placeholder="Enter password"/>
                            <span class="err-password err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Confirm Password</label>
                            <input id="password_confirmation" class="password_confirmation" type="password" placeholder="Enter confirm password"/>
                            <span class="err-password_confirmation err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Date of Birth</label>
                            <input id="birthdate" class="birthdate" type="date"/>
                            <span class="err-birthdate err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>First Name</label>
                            <input id="first_name" class="first_name" type="text" placeholder="Enter first name"/>
                            <span class="err-first_name err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Middle Name</label>
                            <input id="middle_name" class="middle_name" type="text" placeholder="Enter middle name"/>
                            <span class="err-middle_name err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Last Name</label>
                            <input id="last_name" class="last_name" type="text" placeholder="Enter last name"/>
                            <span class="err-last_name err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Prefix</label>
                            <input id="prefix" class="prefix" type="text" placeholder="Enter prefix"/>
                            <span class="err-prefix err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Gender</label>
                            <select id="gender" class="gender">
                                <option disabled selected>Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                            <span class="err-gender err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Education Level</label>
                            <select class="education_level" id="education_level">
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
                            <input class="adress" id="address" type="text" placeholder="Enter complete address">
                            <span class="err-address err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Zip Code</label>
                            <input class="zip_code" id="zip_code" type="text" placeholder="Enter zip code">
                            <span class="err-zip_code err-msg"></span>
                        </div>
                    </div>
                </div>
             </div>
             <div class="form second" id="form-second">
                 <div class="details ID">
                    <span class="title">Identity Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Upload CV</label>
                            <input class="resume" id="resume" type="file" accept=".pdf">
                            <span class="err-resume err-msg"></span>
                          </div>

                          <div class="input-field">
                            <label>Upload PWD ID card / Recent medical records</label>
                            <input class="pwd_card" id="pwd_card" type="file" accept=".png,.jpeg,.jpg">
                            <span class="err-pwd_card err-msg"></span>
                          </div>

                          <div class="input-field">
                            <label>Profile Pricture</label>
                            <input class="profile_photo" id="profile_photo" type="file" accept=".png,.jpeg,.jpg">
                            <span class="err-profile_photo err-msg"></span>
                          </div>
                        <div class="input-field terms_condition">
                            <input class="accept-agreement" id="accept-agreement" type="checkbox">
                            <a href="javascript:void(0)" class="read-agreement" id="read-agreement">
                            	<label>I certify that I have read and accept to PWDIn’s Terms of Use and Privacy Statement </label>
                            </a>
                            <p class="err-agreement"></p>
                        </div>

                    <button class="nextBtn btn-submit">Submit</button>
                  </div> 
                </div>
        </div>
    </div>


     <!-- The modal -->
	<div id="agreement-modal" class="modal">
		<!-- Modal content -->
		<div class="modal-content">
			<div class="modal-header">
				<h2>Terms and Conditions</h2>
				<span class="modal-close">&times;</span>
			</div>
			<div class="modal-body">
				<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi vel praesentium expedita quas qui iste sit, iusto hic? Odio, atque possimus quae sunt nostrum, molestiae sed quod maiores impedit ipsa!</p>
			</div>
			<div class="modal-footer">
				<button class="primary-btn btn-agree">Agree</button>
			</div>
		</div>
	</div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    	// on first load of page
    	$(document).ready(function() {
    		getProvinces()
    	})

    	// => means anonymous function

    	function getProvinces() {
			fetch('{{asset('/json/provinces.json')}}')
			.then(response => response.json()) // convert string to json
			.then(data => { // data is the parameter
				// var html = "<option selected disabled>Please select</option>";
				var html = "";
				var selected = "";
				$.each(data, function(index, item) {
					var selected = (index === 0) ? "selected" : "";
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
					html += `<option value="${item.name}">${item.name}</option>`
				});

				$('.city').html(html);
			})
			.catch(error => {
				console.log('Error:', error);
			});
    	}


    	$(document).on('click', '.read-agreement', function() {
            $('#agreement-modal').show()
        })

        $(document).on('click', '.btn-agree', function() {
            $('.accept-agreement').prop('checked', true)
            $('.modal').hide()
        })


        $(document).on('click', '.modal-close', function() {
        	closeModal()
        })

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

		
    	$('.btn-submit').on('click', function() {

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
		                	Swal.fire({
							  title: 'Registration Pending',
							  text: 'Please anticipate a verification process for your account that may take up to three days.',
							  icon: 'info',
							  showCancelButton: false,
							  confirmButtonText: 'OK'
							}).then((result) => {
							  if (result.isConfirmed) {
							  	window.location.href = '{{url('/')}}'
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