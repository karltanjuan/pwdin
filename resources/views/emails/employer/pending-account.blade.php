@component('mail::message')


Hi {{ $username }},<br>

Welcome to PWDIn. Thank you for your registration. Please wait for up to 3 days for your employer account to be verified.<br><br>

Thank you,<br>
{{ env('APP_NAME') }} <br>

<a href="https://pwdin.online/employer/login" class="btn-update btn btn-primary btn-lg mb-5" style="padding-left: 2.5rem; padding-right: 2.5rem;">Back to website</a>

@endcomponent
