@component('mail::message')


Hi {{ $username }},<br>

Welcome to PWDIn. Thank you for your registration. Please wait for up to 3 days for your applicant account to be verified.<br><br>

Thank you,<br>
{{ env('APP_NAME') }} <br>

@endcomponent
