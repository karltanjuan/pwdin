<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Candidate Registration</title>
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

        <div id="form" action="#">
            <div class="form first" id="form-first">
                <div class="details personal">
                    <span class="title">Personal Details</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>First Name</label>
                            <input type="text" placeholder="Enter your name" required>
                        </div>
                        <div class="input-field">
                            <label>Last Name</label>
                            <input type="text" placeholder="Enter your name" required>
                        </div>
                        <div class="input-field">
                            <label>Middle Initial</label>
                            <input type="text" placeholder="Enter your name" >
                        </div>
                        <div class="input-field">
                            <label>Prefix</label>
                            <input type="text" placeholder="Enter your name" >
                        </div>
                        <div class="input-field">
                            <label>Gender</label>
                            <select required>
                                <option disabled selected>Select gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Others</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label>Date of Birth</label>
                            <input type="date" placeholder="Enter birth date" required>
                        </div>
                        <div class="input-field">
                            <label>Mobile Number</label>
                            <input type="text" placeholder="Enter your name" required>
                        </div>
                        <div class="input-field">
                            <label>Address</label>
                            <input type="text" placeholder="Enter your name" required>
                        </div>
                        <div class="input-field">
                            <label>City</label>
                            <input type="text" placeholder="Enter your name" required>
                        </div>
                        <div class="input-field">
                            <label>Zip Code</label>
                            <input type="text" placeholder="Enter your name" required>
                        </div>
                        <div class="input-field">
                            <label>Email</label>
                            <input type="text" placeholder="Enter your email" required>
                        </div>
                        <div class="input-field">
                            <label>Password</label>
                            <input type="text" placeholder="Enter your email" required>
                        </div>
                        <div class="input-field">
                            <label>Confirm Password</label>
                            <input type="text" placeholder="Enter your email" required>
                        </div>
                        
                    </div>
                </div>
             </div>
             <div class="form second" id="form-second">
                 <div class="details ID">
                    <span class="title">Identity Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>UPLOAD CV</label>
                            <input type="file" name="cv" accept=".pdf" required>
                          </div>

                          <div class="input-field">
                            <label>UPLOAD PWD ID CARD/RECENT MEDICAL RECORDS</label>
                            <input type="file" name="cv" accept=".pdf,.png,.jpeg,.jpg" required>
                          </div>

                          <div class="input-field">
                            <label>Profile Pricture</label>
                            <input type="file" name="cv" accept=".png,.jpeg,.jpg" required>
                          </div>
                        <div class="input-field terms_condition">
                            <input type="checkbox" required>
                            <label>I certify that I have read and accept to PWDIn’s Terms of Use and Privacy Statement </label>
                        </div>

                    <button class="nextBtn btn-submit">
                        <span class="btnText">Submit</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                  </div> 
                </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    	$('.btn-submit').on('click', function() {

    		// sweet alert
    		Swal.fire({
			  title: 'Application Pending',
			  text: 'Please wait for up to 3 days for your account to be verified.',
			  icon: 'info',
			  showCancelButton: false,
			  confirmButtonText: 'OK'
			}).then((result) => {
			  if (result.isConfirmed) {
			  	window.location.href = '{{url('/')}}'
			  }
			});
    	})
    </script>
</body>
</html>