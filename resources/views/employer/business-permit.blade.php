@extends('employer.layouts.master')

@section('title', 'Employer - Change Business Permit')
@section('cover_page')
    <li class="breadcrumb-item text-white active">Settings</li>
    <li class="breadcrumb-item text-white active">Business Permit</li>
@endsection

@section('content')
    <style>

    </style>

    <h1 class="text-center mb-1 wow fadeInUp title-label" data-wow-delay="0.1s">Change Business Permit</h1>
    <p class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Upload your latest business permit</p>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    {{-- Business Permit --}}
                    <div class="input-group">
                        <input type="file" class="form-control form-control-lg business_permit" id="business_permit"
                            accept=".pdf,.png,.jpeg,.jpg">
                        <label class="input-group-text" for="business_permit">Upload Business Permit</label>
                    </div>
                    <span class="err-business_permit err-msg mb-4"></span>

                    @php
                        $business_permit = str_replace(
                            'public',
                            'storage',
                            auth()
                                ->guard('employers')
                                ->user()->business_permit,
                        );
                        $path = pathinfo($business_permit);
                    @endphp

                    @if (isset($path['extension']) && $path['extension'] == 'pdf')
                        <a href="{{ asset($business_permit) }}" target="_blank" type="button"
                            class="btn btn-outline-secondary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">View business permit</a>
                    @endif

                    @if (isset($path['extension']) && in_array($path['extension'], ['png', 'jpg', 'jpeg']))
                        <img class="rounded border w-100 img-fluid img-preview" src="{{ asset($business_permit) }}"
                            alt="Business Permit">
                    @endif

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="button" class="btn-update btn btn-primary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Save Business Permit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('employer.layouts.scripts')

    <script>
        $('.business_permit').on('change', function(event) {
            const selectedImage = event.target.files[0];

            if (selectedImage) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    $('.img-preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(selectedImage);
            }
        });

        let click_counter = 0;

        $('.btn-update').on('click', function() {
            $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`);

            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('old_file', '{{ auth()->guard('employers')->user()->business_permit }}');
            formData.append('business_permit', $('#business_permit')[0].files[0]);

            if (click_counter === 0) {
                click_counter++;
                $(this).prop('disabled', true);

                $.ajax({
                    url: '{{ route('employer.updateBusinessPermit') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.code == "200") {
                            $('.btn-update').html(`Save Business Permit`);
                            toastr.success('Business Permit change successfully', 'Success')

                            setTimeout(function() {
                                window.location.href = '{{ url('/employer/business-permit') }}'
                            }, 2000)
                        } else {
                            displayErrors(JSON.parse(response.errors));
                            $('.btn-update').html(`Save Business Permit`).prop('disabled', false);
                            click_counter = 0;
                        }
                    },
                    error: function(xhr, status, error) {
                        var result = JSON.parse(xhr.responseText)
                        displayErrors(result.errors)
                        $('.btn-update').html(`Save Business Permit`).prop('disabled', false);
                        click_counter = 0;
                    }
                });
            }

        })
    </script>
@endsection
