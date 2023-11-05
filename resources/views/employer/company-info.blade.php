@extends('employer.layouts.master')

@section('title', 'Employer - Company Information')
@section('cover_page')
    <li class="breadcrumb-item text-white active">Settings</li>
    <li class="breadcrumb-item text-white active">Company Information</li>
@endsection

@section('content')
    <style>
        .select2-selection {
            min-height: 58px !important;
        }
    </style>
    
    @php $user = auth()->guard('employers')->user() @endphp

    <h1 class="text-center mb-5 wow fadeInUp title-label" data-wow-delay="0.1s">Company Information</h1>

    <div class="row wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
                @php
                    $company_logo = str_replace('public', 'storage', $user->company_logo);
                @endphp

                @if(!empty($company_logo))
                    <img src="{{asset($company_logo)}}" alt="avatar" class="rounded-circle img-fluid img-preview" style="width: 150px;height:150px;">
                @else
                    <img src="{{asset('/img/default_avatar.png')}}" alt="avatar" class="rounded-circle img-fluid img-preview" style="width: 150px;height:150px;">
                @endif

                <h5 class="my-3">{{$user->company_name}}</h5>
                <p class="text-muted mb-4">{{$user->city}}, {{$user->province}}</p>

                <div class="input-group">
                    <input type="file" class="form-control form-control-md company_logo" id="company_logo" tabindex="18"
                        accept=".jpg,.jpeg,.png">
                    <label class="input-group-text" for="company_logo">Company Logo</label>
                </div>
                <span class="err-company_logo err-msg mb-4"></span>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="text" id="username" class="form-control form-control-lg username"
                            placeholder="Enter username" tabindex="1" value="{{$user->username}}"/>
                        <label class="form-label" for="username">Username</label>
                        <span class="err-username err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="email" id="email" class="form-control form-control-lg email"
                            placeholder="Enter email address" tabindex="2" value="{{$user->email}}"/>
                        <label class="form-label" for="email">Email Address</label>
                        <span class="err-email err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="number" id="mobile_no" class="form-control form-control-lg mobile_no"
                            placeholder="Enter mobile number" tabindex="3" value="{{$user->mobile_no}}"/>
                        <label class="form-label" for="mobile_no">Mobile Number</label>
                        <span class="err-mobile_no err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="text" id="contact_person" class="form-control form-control-lg contact_person"
                            placeholder="Enter contact person" tabindex="5" value="{{$user->contact_person}}"/>
                        <label class="form-label" for="contact_person">Contact Person</label>
                        <span class="err-contact_person err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="text" id="company_name" class="form-control form-control-lg company_name"
                            placeholder="Enter company name" tabindex="5" value="{{$user->company_name}}"/>
                        <label class="form-label" for="company_name">Company Name</label>
                        <span class="err-company_name err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-4">
                        <select class="province form-select" id="province" tabindex="11"></select>
                        <label for="province">Province</label>
                        <span class="err-province err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-4">
                        <select class="city form-select" id="city" tabindex="12"></select>
                        <label for="city">City</label>
                        <span class="err-city err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="text" id="address" class="form-control form-control-lg address"
                            placeholder="Enter address" tabindex="13" value="{{$user->address}}"/>
                        <label class="form-label" for="address">Address</label>
                        <span class="err-address err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="text" id="zip_code" class="form-control form-control-lg zip_code"
                            placeholder="Enter zip_code" tabindex="14" value="{{$user->zip_code}}"/>
                        <label class="form-label" for="zip_code">Zip Code</label>
                        <span class="err-zip_code err-msg"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                        <textarea class="form-control summary" id="summary" rows="15" style="height:100px;" placeholder="Summary">{{$user->summary}}</textarea>
                        <label for="summary">Enter summary</label>
                        <span class="err-summary err-msg"></span>
                    </div>
                </div>

                <div class="text-center text-lg-start pt-2">
                    <button type="button" class="btn-update btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Save Company</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    @include('employer.layouts.scripts')
    <script>
        $(document).ready(function() {
            getProvinces()
            $('.province').val('{{$user->province}}')
            setTimeout(function() {
                province_code = $('.province>option:selected').data('key')
                console.log(province_code)
                getCities(province_code)
            }, 500)
        })

        $('.company_logo').on('change', function(event) {
            const selectedImage = event.target.files[0];
            
            if (selectedImage) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    $('.img-preview').attr('src', e.target.result);
                };
                
                reader.readAsDataURL(selectedImage);
            }
        });

        function getProvinces() {
            fetch('{{asset('/json/provinces.json')}}')
            .then(response => response.json()) 
            .then(data => {
                var html = "";
                var selected = "";
                $.each(data, function(index, item) {

                    // var selected = (index === 0) ? "selected" : "";
                    var selected = ""
                    if (item.name == '{{$user->province}}') {
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
            fetch('{{asset('/json/cities.json')}}')
            .then(response => response.json()) 
            .then(data => {
                var filtered_cities = $(data).filter((index, city) => city.province === province_code).toArray();

                var html = "";
                $.each(filtered_cities, function(index, item) {
                    var selected = ""
                    if (item.name == '{{$user->city}}') {
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

        $('.btn-update').on('click', function() {
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('old_file', '{{$user->company_logo}}');
            formData.append('company_logo', $('#company_logo')[0].files[0]);
            formData.append('username', $('#username').val());
            formData.append('email', $('#email').val());
            formData.append('mobile_no', $('#mobile_no').val());
            formData.append('contact_person', $('#contact_person').val());
            formData.append('company_name', $('#company_name').val());
            formData.append('province', $('#province').val());
            formData.append('city', $('#city').val());
            formData.append('address', $('#address').val());
            formData.append('zip_code', $('#zip_code').val());
            formData.append('summary', $('#summary').val());

            $.ajax({
                url: '{{ route('employer.updateCompanyInfo') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                        toastr.success('Company information updated successfully', 'Success')
            
                        setTimeout(function() {
                                window.location.href = '{{url('/employer/company-info')}}'
                            }, 2000)
                    } else {
                        displayErrors(JSON.parse(response.errors));
                    }
                },
                error: function(xhr, status, error) {
                    var result = JSON.parse(xhr.responseText)
                    displayErrors(result.errors)
                }
            });
        })
    </script>
@endsection
