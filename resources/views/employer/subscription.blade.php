@extends('employer.layouts.master')

@section('title', 'Employer - Subscription')
@section('cover_page')
    <li class="breadcrumb-item text-white active">Subscription</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="text-center mb-5">Subscription</h1>
            <div class="card">
                <div class="card-body">
                    @if ($is_expire)
                        <p>Subscribe 1 year for unlimited job posting.</p>
                        <button class="btn btn-primary btn-lg btn-subscribe"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Subscribe</button>
                    @else
                        <p class="mb-3"><b>You are subscribed for 1 year unlimited job posting.</b></p>
                        <table class="table table-sm table-bordered">
                            <tr>
                                <th>Reference No.</th>
                                <th>Payment Method</th>
                                <th>Amount</th>
                                <th>Expiration Date</th>
                            </tr>
                            <tr>
                                <td>
                                    <span class="badge bg-dark bg-dark">{{strtoupper($invoice->reference_number)}}</span>
                                </td>
                                <td>
                                    <span class="badge bg-dark bg-dark">{{strtoupper($invoice->payment_method)}}</span>
                                </td>
                                <td>
                                    <span class="badge bg-dark bg-dark">
                                        &#8369;
                                        {{strtoupper(number_format($invoice->total_amount / 100, 2, '.', ','))}}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-dark bg-dark">{{$expired_at}}</span>
                                </td>
                            </tr>
                        </table>

                        <img src="{{asset('img/subscription.jpg')}}" alt="Subscription" class="img-fluid">
                    @endif
                </div>
            </div>
        </div>
    </div>


    <script>
        let click_counter = 0;

        $(document).on('click', '.btn-subscribe', function() {
            $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`);

            setTimeout(function() {
                var formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");

                if (click_counter === 0) {
                    click_counter++;
                    $(this).prop('disabled', true);
                    
                    toastr.info('Please wait', 'Creating invoice and redirecting you to payment service provider.');

                    $.ajax({
                        url: '{{ route('employer.createInvoice') }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $('.btn-login').html(`Subscribe`);
                            window.location.href = response.data.attributes.checkout_url
                        },
                        error: function(xhr, status, error) {
                            var result = JSON.parse(xhr.responseText)
                            console.log(result)
                            $('.btn-subscribe').html(`Subscribe`).prop('disabled', false);
                            click_counter = 0;
                        }
                    });
                }
            }, 2000)
        })
    </script>
@endsection
