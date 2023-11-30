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
            <div class="text-center text-lg-s   tart mt-4 pt-2">
                <button type="button" class="btn-update btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Save Password</button>
            </div>
        </div>
    </div>
    
</div>

<script src="{{ asset('js/main.js') }}"></script>
<script>
    let click_counter = 0;
    $('.btn-update').on('click', function() {
        $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`);

        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('current_password', $('#current_password').val());
        formData.append('new_password', $('#new_password').val());
        formData.append('password_confirmation', $('#password_confirmation').val());

        if (click_counter === 0) {
                click_counter++;
                $(this).prop('disabled', true);

            $.ajax({
                url: '{{ route('admin.updatePassword') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                        $('.btn-update').html(`Save Password`);
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
                        $('.btn-update').html(`Save Password`).prop('disabled', false);
                        click_counter = 0;
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
                    $('.btn-update').html(`Save Password`).prop('disabled', false);
                        click_counter = 0;
                }
            });
        }
    })

    (function(d){
           var s = d.createElement("script");
           /* uncomment the following line to override default position*/
           s.setAttribute("data-position", 100);
           /* uncomment the following line to override default size (values: small, large)*/
           /* s.setAttribute("data-size", "large");*/
           /* uncomment the following line to override default language (e.g., fr, de, es, he, nl, etc.)*/
           /* s.setAttribute("data-language", "null");*/
           /* uncomment the following line to override color set via widget (e.g., #053f67)*/
           /* s.setAttribute("data-color", "#2d68ff");*/
           /* uncomment the following line to override type set via widget (1=person, 2=chair, 3=eye, 4=text)*/
           /* s.setAttribute("data-type", "1");*/
           /* s.setAttribute("data-statement_text:", "Our Accessibility Statement");*/
           /* s.setAttribute("data-statement_url", "http://www.example.com/accessibility";*/
           /* uncomment the following line to override support on mobile devices*/
           /* s.setAttribute("data-mobile", true);*/
           /* uncomment the following line to set custom trigger action for accessibility menu*/
           /* s.setAttribute("data-trigger", "triggerId")*/
           s.setAttribute("data-account", "HaifC5drHg");
           s.setAttribute("src", "https://cdn.userway.org/widget.js");
           (d.body || d.head).appendChild(s);})(document)

</script>
@endsection
