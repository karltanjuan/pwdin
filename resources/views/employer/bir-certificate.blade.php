@extends('employer.layouts.master')

@section('title', 'Employer - Change BIR Certificate')
@section('cover_page')
    <li class="breadcrumb-item text-white active">Settings</li>
    <li class="breadcrumb-item text-white active">BIR Certificate</li>
@endsection

@section('content')
    <style>
        
    </style>

    <h1 class="text-center mb-1 wow fadeInUp title-label" data-wow-delay="0.1s">Change BIR Certificate</h1>
    <p class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Upload your latest bir certificate</p>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    {{-- BIR Certificate --}}
                    <div class="input-group">
                        <input type="file" class="form-control form-control-lg bir_certificate" id="bir_certificate" accept=".pdf,.png,.jpeg,.jpg">
                        <label class="input-group-text" for="bir_certificate">Upload BIR Certificate</label>
                    </div>
                    <span class="err-bir_certificate err-msg mb-4"></span>

                    @php
                        $bir_certificate = str_replace('public', 'storage', auth()->guard('employers')->user()->bir_certificate);
                        $path = pathinfo($bir_certificate);
                    @endphp

                    @if (isset($path['extension']) && $path['extension'] == "pdf")
                        <a href="{{asset($bir_certificate)}}" target="_blank" type="button" class="btn btn-outline-secondary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">View BIR certificate</a>
                    @else
                        <img class="rounded border w-100 img-fluid img-preview" src="{{asset($bir_certificate)}}" alt="BIR Certificate">
                    @endif
                    
                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="button" class="btn-update btn btn-primary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Save BIR Certificate</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('employer.layouts.scripts')

    <script>
        $('.bir_certificate').on('change', function(event) {
            const selectedImage = event.target.files[0];
            
            if (selectedImage) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    $('.img-preview').attr('src', e.target.result);
                };
                
                reader.readAsDataURL(selectedImage);
            }
        });

        $('.btn-update').on('click', function() {
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('old_file', '{{auth()->guard('employers')->user()->bir_certificate}}');
            formData.append('bir_certificate', $('#bir_certificate')[0].files[0]);

            $.ajax({
                url: '{{ route('employer.updateBIRCertificate') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                        toastr.success('BIR Certificate change successfully', 'Success')

                        setTimeout(function() {
                            window.location.href = '{{url('/employer/bir-certificate')}}'
                        }, 2000)
                    } else {
                        displayErrors(JSON.parse(response.errors));
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the AJAX request error
                    var result = JSON.parse(xhr.responseText)
                    displayErrors(result.errors)
                }
            });
    
        })
    </script>
@endsection
