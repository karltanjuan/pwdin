<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/forEmployerRegis.css')}}">
    <script src="switch-page.js"></script>
    <title>Employer Registration</title>
</head>
<body>
    <input type="checkbox" class="toggle" id="toggle">
    <!--navbar-->
    <nav class="navbar"> 
        <a href="{{url('/')}}">
            <img src="{{asset('img/logo.png')}}" class="logo" alt="PWD Logo"/>
        </a>
        <label class="navbar-toggler" for="toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </label>
        <div class="navbar-buttons">  
            <a href="home">Home</a>
            <a href="job_seeker">Job Seekers</a>
            <a href="employer">Employers</a>
            <a href="about_us">About Us</a>
        </div>
       
    </nav>

    <!--the parent mismo-->
    <div class="container">
        <header>Employer Registration</header>

        <div id="form">
            <div class="form first" id="form-first">
                <div class="details personal">
                    <span class="title">Company Information</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Company Name</label>
                            <input type="text" id="company-name" class="company-name"  placeholder="Enter Company Name" >
                            <span class="err-username err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Phone Number</label>
                            <input type="text" id="phone-num" class="phone-num" placeholder="Enter phone number" >
                            <span class="err-username err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Company Type</label>
                            <input type="text" id="company-type" class="company-type" placeholder="Enter company type" >
                            <span class="err-username err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Culture Initiatives</label>
                            <input type="text" id="culture-initiatives" class="culture-initiatives" placeholder="Enter culture initiatives" >
                            <span class="err-username err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Country</label>
                            <input type="text" id="country" class="country" placeholder="Enter country" >
                            <span class="err-username err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Zip Code</label>
                            <input type="text" placeholder="Enter your name" >
                            <span class="err-username err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>City</label>
                            <input type="text" placeholder="Enter your name" >
                            <span class="err-username err-msg"></span>
                        </div>
                    </div>
                </div>
            </div>
             <div class="form second" id="form-second">
                 <div class="details ID">
                    <span class="title">Employer Login Information</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>First Name</label>
                            <input type="text" placeholder="Enter first name" >
                            <span class="err-username err-msg"></span>
                        </div>

                        <div class="input-field">
                            <label>Last Name</label>
                            <input type="text" placeholder="Enter last name">
                            <span class="err-username err-msg"></span>
                        </div>

                        <div class="input-field">
                            <label>Email</label>
                            <input type="email" placeholder="Enter email">
                            <span class="err-username err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Password</label>
                            <input type="text" placeholder="Enter password" >
                            <span class="err-username err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Confirm Password</label>
                            <input type="text" placeholder="Confirm Password" >
                            <span class="err-username err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Mobile Number</label>
                            <input type="text" placeholder="Enter mobile number">
                            <span class="err-username err-msg"></span>
                        </div>
                        <div class="input-field terms_condition">
                            <input type="checkbox" required>
                            <label>I certify that I have read and accept to PWDIn Terms of Use and Privacy Statement </label>
                        </div>

                    <button class="nextBtn btn-submit">Submit</button>
                </div> 
            </div>
            </div>
        </div>
    </div>



</body>
</html>