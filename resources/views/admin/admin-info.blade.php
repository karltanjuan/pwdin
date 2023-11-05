@extends('admin.layouts.master')

@php $page_title = "Admin Information"; @endphp
@section('title', 'Admin - '.$page_title)

@section('content')
<style>
    .err-msg {
        color: red;
        font-size: 12px;
        display: flex;
    }

    .error {
        border: 1px solid red !important;
    }
</style>

@php $user = auth()->guard('admins')->user() @endphp
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-5">{{$page_title}}</h1>

    <div class="row wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
                @php
                    $profile_photo = str_replace('public', 'storage', $user->profile_photo);
                @endphp

                @if(!empty($profile_photo))
                    <img src="{{asset($profile_photo)}}" alt="avatar" class="rounded-circle img-fluid img-preview" style="width: 150px;height:150px;">
                @else
                    <img src="{{asset('/img/default_avatar.png')}}" alt="avatar" class="rounded-circle img-fluid img-preview" style="width: 150px;height:150px;">
                @endif

                <h5 class="my-3">{{$user->company_name}}</h5>
                <p class="text-muted mb-4">{{$user->city}}, {{$user->province}}</p>

                <div class="input-group">
                    <input type="file" class="form-control form-control-md profile_photo" id="profile_photo" tabindex="8"
                        accept=".jpg,.jpeg,.png">
                    <label class="input-group-text" for="profile_photo">Company Logo</label>
                </div>
                <span class="err-profile_photo err-msg mb-4"></span>
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
                        <input type="text" id="first_name" class="form-control form-control-lg first_name"
                            placeholder="Enter first name" tabindex="3" value="{{$user->first_name}}"/>
                        <label class="form-label" for="first_name">First Name</label>
                        <span class="err-first_name err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="text" id="middle_name" class="form-control form-control-lg middle_name"
                            placeholder="Enter middle name" tabindex="4" value="{{$user->middle_name}}"/>
                        <label class="form-label" for="middle_name">Middle Name</label>
                        <span class="err-middle_name err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="text" id="last_name" class="form-control form-control-lg last_name"
                            placeholder="Enter last name" tabindex="5" value="{{$user->last_name}}"/>
                        <label class="form-label" for="last_name">Last Name</label>
                        <span class="err-last_name err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="text" id="prefix" class="form-control form-control-lg prefix"
                            placeholder="Enter prefix" tabindex="6" value="{{$user->prefix}}"/>
                        <label class="form-label" for="prefix">Prefix</label>
                        <span class="err-prefix err-msg"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline mb-4 form-floating">
                        <input type="number" id="mobile_no" class="form-control form-control-lg mobile_no"
                            placeholder="Enter mobile number" tabindex="7" value="{{$user->mobile_no}}"/>
                        <label class="form-label" for="mobile_no">Mobile Number</label>
                        <span class="err-mobile_no err-msg"></span>
                    </div>
                </div>

                <div class="text-center text-lg-start pt-2">
                    <button type="button" class="btn-update btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;" tabindex="9">Save Profile</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>



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

    $('.profile_photo').on('change', function(event) {
        const selectedImage = event.target.files[0];
        
        if (selectedImage) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                $('.img-preview').attr('src', e.target.result);
            };
            
            reader.readAsDataURL(selectedImage);
        }
    });

    $('.btn-update').on('click', function() {
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('old_file', '{{auth()->guard('admins')->user()->profile_photo}}');
        formData.append('profile_photo', $('#profile_photo')[0].files[0]);
        formData.append('username', $('#username').val());
        formData.append('email', $('#email').val());
        formData.append('mobile_no', $('#mobile_no').val());
        formData.append('first_name', $('#first_name').val());
        formData.append('middle_name', $('#middle_name').val());
        formData.append('last_name', $('#last_name').val());
        formData.append('prefix', $('#prefix').val());

        $.ajax({
            url: '{{ route('admin.updateAdminInfo') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.code == "200") {
                    toastr.success('Admin information updated successfully', 'Success')

                    setTimeout(function() {
                            window.location.href = '{{url('/admin/profile-info')}}'
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
