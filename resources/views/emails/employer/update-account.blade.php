@component('mail::message')


Hi {{ $username }},<br>

{{ $message }}<br><br>

Thank you,<br>
{{ env('APP_NAME') }} <br>

<a href="https://pwdin.online/employer/login" class="btn-update btn btn-primary btn-lg mb-5" style="padding-left: 2.5rem; padding-right: 2.5rem;">Back to website</a>

@endcomponent
