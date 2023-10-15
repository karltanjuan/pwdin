@extends('employer.layouts.master')

@section('title', 'Employer Job Post')

@section('content')

    <h1>Subscription</h1>
    @if ($is_expire)
        <p>Subscribe 1 year for unlimited job posting.</p>
        <button class="btn-subscribe primary-btn">Subscribe</button>
    @else 
        <p><b>You are subscribed for 1 year unlimited job posting.</b></p>
    @endif
   

	<script>
        $(document).on('click', '.btn-subscribe', function() {
			Swal.fire({
				title: 'Please wait',
				text: 'Creating invoice and redirecting you to payment service provider.',
				icon: 'info',
				showCancelButton: false,
				confirmButtonText: 'OK'
			});

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