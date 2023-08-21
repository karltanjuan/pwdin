@component('mail::message')


Hi {{ $username }},<br>

{{ $message }}<br><br>

Thank you,<br>
{{ env('APP_NAME') }} <br>

@endcomponent
