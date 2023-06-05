@component('mail::message')


Hi {{ $email }},<br>

You recently requested to reset your password for your account. Use the link below to reset it.<br><br>

<a href="{{ url('admin/reset-password/') }}/{{ $token }}">Reset your password</a><br><br>

For security, this request was received from a {{ $operating_system }} device using {{ $browser }}. If you did not request a password reset, ignore this email. <br><br>


Thank you,<br>
{{ env('APP_NAME') }} <br>


If you're having trouble with the link above, copy and paste the URL below into your web browser. <br>

{{ url("admin/reset-password/") }}/{{ $token }}

@endcomponent
