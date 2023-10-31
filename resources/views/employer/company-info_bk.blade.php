@extends('employer.layouts.master')

@section('title', 'Employer - Company Info')

@section('content')
    <style>
        .content {
            padding: 0;
        }

        .summary {
            outline: none;
            font-size: 14px;
            font-weight: 400;
            color: #333;
            border-radius: 5px;
            border: 1px solid #aaa;
            padding: 0 15px;
            height: 42px;
            margin: 8px 0;
        }
    </style>
    <div class="content-0">
        <div class="head-container">
            <h1>Company Information</h1>
            @php
                $user = auth()->guard('employers')->user();
            @endphp
        </div>

        <div class="content">
            <div class="logo-container">
                @if (auth()->guard('employers')->user()->company_logo != null)
                    @php
                    $company_logo = str_replace('public', 'storage', auth()->guard('employers')->user()->company_logo);
                    @endphp
                    
                    <img class="company-logo-info" src="{{asset($company_logo)}}" alt="Company Logo">
                @else
                    <img class="company-logo-info" src="{{asset($company_logo)}}" alt="Company Logo">
                @endif
            </div>
            <div id="form">
                <div class="form first" id="form-first">
                    <div class="details personal">
                        <div class="fields">
                            <div class="input-field">
                                <label>Company Logo</label>
                                <input class="company_logo" id="company_logo" type="file" accept=".png,.jpeg,.jpg">
                                <span class="err-company_logo err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Username</label>
                                <input id="username" class="username" type="text" placeholder="Enter username" value="{{$user->username}}"/>
                                <span class="err-username err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Email Address</label>
                                <input id="email" class="email" type="text" placeholder="Enter email address" value="{{$user->email}}"/>
                                <span class="err-email err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Mobile Number</label>
                                <input id="mobile_no" class="mobile_no" type="number" placeholder="Enter mobile number" value="{{$user->mobile_no}}"/>
                                <span class="err-mobile_no err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Contact Person</label>
                                <input id="contact_person" class="contact_person" type="text" placeholder="Enter contact person" value="{{$user->contact_person}}"/>
                                <span class="err-contact_person err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Company Name</label>
                                <input id="company_name" class="company_name" type="text" placeholder="Enter company name" value="{{$user->company_name}}"/>
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
                                </select>
                                <span class="err-city err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Zip Code</label>
                                <input class="zip_code" id="zip_code" type="text" placeholder="Enter zip code" value="{{$user->zip_code}}">
                                <span class="err-zip_code err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Address</label>
                                <input class="address" id="address" type="text" placeholder="Enter complete address" value="{{$user->address}}">
                                <span class="err-address err-msg"></span>
                            </div>
                            <div class="input-field">
                                <label>Summary</label>
                                <textarea class="summary" id="summary" type="text" placeholder="Enter summary">{{$user->summary}}</textarea>
                                <span class="err-summary err-msg"></span>
                            </div>
                            <div class="input-field"></div>
                        </div>

                        <button class="primary-btn btn-update">Save Company</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <script>

            $(document).ready(function() {
                getProvinces()

                $('.province').val('{{auth()->guard('employers')->user()->province}}')
                setTimeout(function() {
                    province_code = $('.province>option:selected').data('key')
                    getCities(province_code)
                }, 500)
            })

            function getProvinces() {
                fetch('{{asset('/json/provinces.json')}}')
                .then(response => response.json()) 
                .then(data => {
                    var html = "";
                    var selected = "";
                    $.each(data, function(index, item) {

                        // var selected = (index === 0) ? "selected" : "";
                        var selected = ""
                        if (item.name == '{{auth()->guard('employers')->user()->province}}') {
                            selected = 'selected'
                        }

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
                province_code = $(this).find('option:selected').data('key') 
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
                        var selected = ""
                        if (item.name == '{{auth()->guard('employers')->user()->city}}') {
                            selected = "selected"
                        }
                        html += `<option ${selected} value="${item.name}">${item.name}</option>`
                    });

                    $('.city').html(html);
                })
                .catch(error => {
                    console.log('Error:', error);
                });
            }

            var err_counter = 0;
            function displayErrors(errors) {
                $('.err-msg').text('');
                // $('.error').css('border', 'none')
                $('.err-msg').siblings('input, select').removeClass('error');

                $.each(errors, function(field, messages) {
                    var errMsgSelector = '.err-' + field;
                    var inputSelector = '#' + field;
                    $(errMsgSelector).text(messages[0]);
                    $(inputSelector).addClass('error');
                });

                $("html, body").animate({ scrollTop: 0 }, "slow");
            }

            $('.btn-update').on('click', function() {
                var formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('old_file', '{{auth()->guard('employers')->user()->company_logo}}');
                formData.append('company_logo', $('#company_logo')[0].files[0]);
                formData.append('username', $('#username').val());
                formData.append('email', $('#email').val());
                formData.append('mobile_no', $('#mobile_no').val());
                formData.append('contact_person', $('#contact_person').val());
                formData.append('company_name', $('#company_name').val());
                formData.append('province', $('#province').val());
                formData.append('city', $('#city').val());
                formData.append('zip_code', $('#zip_code').val());
                formData.append('address', $('#address').val());
                formData.append('summary', $('#summary').val());

                $.ajax({
                    url: '{{ route('employer.updateCompanyInfo') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.code == "200") {
                            Swal.fire({
                              title: 'Company information updated successfully',
                              text: '',
                              icon: 'success',
                              showCancelButton: false,
                              confirmButtonText: 'OK'
                            });
                            
                            setTimeout(function() {
                                    window.location.href = '{{url('/employer/company-info')}}'
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
@endsection