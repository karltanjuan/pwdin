@extends('employer.layouts.master')

@section('title', 'Employer - Subscription')
@section('cover_page')
    <li class="breadcrumb-item text-white active">Subscription</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h1>Subscription</h1>
                    @if ($is_expire)
                        <p>Subscribe 1 year for unlimited job posting.</p>
                        <button class="btn btn-primary btn-lg btn-subscribe"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Subscribe</button>
                    @else
                        <p><b>You are subscribed for 1 year unlimited job posting.</b></p>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).on('click', '.btn-subscribe', function() {

            toastr.info('Please wait', 'Creating invoice and redirecting you to payment service provider.');

            setTimeout(function() {
                // Create invoice and transactions
                var formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");

                // Send an AJAX request to validate the data
                $.ajax({
                    url: '{{ route('employer.createInvoice') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        window.location.href = response.data.attributes.checkout_url
                    },
                    error: function(xhr, status, error) {
                        var result = JSON.parse(xhr.responseText)
                        console.log(result)
                    }
                });
            }, 2000)
        })
    </script>
@endsection
