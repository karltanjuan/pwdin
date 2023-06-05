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
            <img src="{{asset('img/logo.png')}}" class="logo" alt="PWD Logo" />
        </a>
        <label class="navbar-toggler" for="toggigggle">
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
                <div class="form first" id="form-first">
                    <div class="details personal">
                        <span class="title">Company Information</span>
                        <div class="fields">
                            <div class="input-field">
                                <label>Company Name</label>
                                <input type="text" placeholder="Enter company name" class="company-name" id="company-name">
                                <span class="err-username err-msg"></span>
                            </div>

                            <div class="input-field">
                                <label>Address</label>
                                <input type="text" placeholder="Enter address" class="address" id="address">
                                <span class="err-username err-msg"></span>
                            </div>

                            <div class="input-field">
                                <label>Province</label>
                                <input type="text" placeholder="Enter province" class="province" id="province">
                                <span class="err-username err-msg"></span>
                            </div>

                            <div class="input-field">
                                <label>City</label>
                                <input type="text" placeholder="Enter city">
                                <span class="err-username err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>ZIP Code</label>
                                <input type="number" placeholder="Confirm Password">
                                <span class="err-username err-msg"></span>
                            </div>

                            <div class="input-field">
                                <label>Summary</label>
                                <input type="text" placeholder="Enter summary">
                                <span class="err-username err-msg"></span>
                            </div>
                            <div>
                                <label>Upload Company Logo</label>
                                <input class="company_logo" id="company_logo" type="file" accept=".pdf,.jpg,.jpeg,.png">
                                <span class="err-resume err-msg"></span>
                            </div>
                            <div>
                                <label>Upload BIR Certificate</label>
                                <input class="bir_certificate" id="bir_certificate" type="file" accept=".pdf,.jpg,.jpeg,.png">
                                <span class="err-resume err-msg"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form second" id="form-second">
                    <div class="employer-info">
                        <span class="title">Employer Login Information</span>

                        <div class="fields">
                            <div class="input-field">
                                <label>Username</label>
                                <input type="text" placeholder="Enter username">
                                <span class="err-username err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Contact Person</label>
                                <input type="text" placeholder="Enter name of contact person">
                                <span class="err-username err-msg"></span>
                            </div>

                            <div class="input-field">
                                <label>Email</label>
                                <input type="email" placeholder="Enter email">
                                <span class="err-username err-msg"></span>
                            </div>

                            <div class="input-field">
                                <label>Password</label>
                                <input type="password" placeholder="Enter password">
                                <span class="err-username err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Confirm Password</label>
                                <input id="password_confirmation" class="password_confirmation" type="password" placeholder="Enter confirm password" />
                                <span class="err-password_confirmation err-msg"></span>
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



</body>

</html>