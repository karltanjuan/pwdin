<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Employer Registration</title>
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
                            <label>Contact Person</label>
                            <input id="contact_person" class="contact_person" type="text" placeholder="Enter contact person"/>
                            <span class="err-contact_person err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Company Name</label>
                            <input id="company_name" class="company_name" type="text" placeholder="Enter company name"/>
                            <span class="err-company_name err-msg"></span>
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
                            <label>Zip Code</label>
                            <input class="zip_code" id="zip_code" type="text" placeholder="Enter zip code">
                            <span class="err-zip_code err-msg"></span>
                        </div>
                        <div class="input-field">
                            <label>Address</label>
                            <input class="adress" id="address" type="text" placeholder="Enter complete address">
                            <span class="err-address err-msg"></span>
                        </div>
                        <div class="input-field"></div>
                    </div>
                </div>
             </div>
             <div class="form second" id="form-second">
                 <div class="identity-details">
                    <span class="title">Identity Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Company Logo</label>
                            <input class="company_logo" id="company_logo" type="file" accept=".png,.jpeg,.jpg">
                            <span class="err-company_logo err-msg"></span>
                          </div>

                          <div class="input-field">
                            <label>Upload Business Permit</label>
                            <input class="business_permit" id="business_permit" type="file" accept=".pdf,.png,.jpeg,.jpg">
                            <span class="err-business_permit err-msg"></span>
                          </div>

                          <div class="input-field">
                            <label>Upload BIR Certificate</label>
                            <input class="bir_certificate" id="bir_certificate" type="file" accept=".pdf,.png,.jpeg,.jpg">
                            <span class="err-bir_certificate err-msg"></span>
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

            $("html, body").animate({ scrollTop: 0 }, "slow");
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
                formData.append('contact_person', $('#contact_person').val());
                formData.append('company_name', $('#company_name').val());
                formData.append('province', $('#province').val());
                formData.append('city', $('#city').val());
                formData.append('zip_code', $('#zip_code').val());
                formData.append('address', $('#address').val());
                formData.append('company_logo', $('#company_logo')[0].files[0]);
                formData.append('business_permit', $('#business_permit')[0].files[0]);
                formData.append('bir_certificate', $('#bir_certificate')[0].files[0]);

                // Send an AJAX request to validate the data
                $.ajax({
                    url: '{{ route('employer.postRegister') }}',
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