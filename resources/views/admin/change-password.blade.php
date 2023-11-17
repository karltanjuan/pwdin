@extends('admin.layouts.master')

@php $page_title = "Change Password"; @endphp
@section('title', 'Admin - '.$page_title)

@section('content')
<style>
    .eye-icon-position {
        display: flex;
        float: right;
        margin-top: -38px;
        margin-right: 12px;
    }

    .err-msg {
        color: red;
        font-size: 12px;
        display: flex;
    }

    .error {
        border: 1px solid red !important;
    }

</style>
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-5">{{$page_title}}</h1>

    <div class="row">
        <div class="col-md-4">
            <!-- Current password input -->
            <div class="form-outline mb-3 form-floating">
                <input type="password" id="current_password" class="form-control form-control-lg current_password"
                    placeholder="Enter current password" />
                <label class="form-label" for="current_password">Current Password</label>
                <span class="show eye-icon-position">
                    <i class="las la-eye fs-5" id="show4" onclick="toggle4()"></i>
                </span>
                <span class="err-current_password err-msg"></span>
            </div>
        </div>
        <div class="col-md-4">
             <!-- New password input -->
             <div class="form-outline mb-3 form-floating">
                <input type="password" id="new_password" class="form-control form-control-lg new_password"
                    placeholder="Enter new password" />
                <label class="form-label" for="new_password">New Password</label>
                <span class="show eye-icon-position">
                    <i class="las la-eye fs-5" id="show1" onclick="toggle1()"></i>
                </span>
                <span class="err-new_password err-msg"></span>
            </div>
        </div>
        <div class="col-md-4">
            <!-- Confirm password input -->
            <div class="form-outline mb-3 form-floating">
                <input type="password" id="password_confirmation"
                    class="form-control form-control-lg password_confirmation"
                    placeholder="Enter password confirmation" />
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <span class="show eye-icon-position">
                    <i class="las la-eye fs-5" id="show2" onclick="toggle2()"></i>
                </span>
                <span class="err-password_confirmation err-msg"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center text-lg-start mt-4 pt-2">
                <button type="button" class="btn-update btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Save Password</button>
            </div>
        </div>
    </div>
    
</div>

<script src="{{ asset('js/main.js') }}"></script>
<script>

    $('.btn-update').on('click', function() {
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('current_password', $('#current_password').val());
        formData.append('new_password', $('#new_password').val());
        formData.append('password_confirmation', $('#password_confirmation').val());

        $.ajax({
            url: '{{ route('admin.updatePassword') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.code == "200") {
                    toastr.success('Password change successfully', 'Success')
                
                    setTimeout(function() {
                        window.location.href = '{{url('/admin/change-password')}}'
                    }, 2000)
                } else {
                    displayErrors(JSON.parse(response.errors));
                    let password_errors = validatePassword($('#new_password').val())
                    let html  = ''
                    $.each(password_errors, function(index,error) {
                        html += `<p class="mb-1">${error}</p>`
                    })
                    $('.err-new_password').addClass('d-block').html(html)
                }
            },
            error: function(xhr, status, error) {
                var result = JSON.parse(xhr.responseText)
                displayErrors(result.errors)
                let password_errors = validatePassword($('#new_password').val())
                let html  = ''
                $.each(password_errors, function(index,error) {
                    html += `<p class="mb-1">${error}</p>`
                })
                $('.err-new_password').addClass('d-block').html(html)
            }
        });
    })

</script>
@endsection
