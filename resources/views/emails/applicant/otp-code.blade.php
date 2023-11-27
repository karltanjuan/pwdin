@component('mail::message')


Hi {{ $email }},<br>

This is your OTP code. Please do not share this to anyone.<br><br>

<b>{{ $otp_code }}</b><br><br>

Thank you,<br>
{{ env('APP_NAME') }} <br>

@endcomponent
