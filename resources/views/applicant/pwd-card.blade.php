@extends('applicant.layouts.master')

@section('title', 'Applicant - Change PWD Card')
@section('cover_page')
    <li class="breadcrumb-item text-white active">Settings</li>
    <li class="breadcrumb-item text-white active">Change PWD Card</li>
@endsection

@section('content')
    <style>
        
    </style>

    <h1 class="text-center mb-1 wow fadeInUp title-label" data-wow-delay="0.1s">Change PWD Card</h1>
    <p class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Unlock your dream job with an outstanding resume!</p>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    {{-- PWD Card --}}
                    <div class="input-group">
                        <input type="file" class="form-control form-control-lg pwd_card" id="pwd_card" accept=".png,.jpeg,.jpg">
                        <label class="input-group-text" for="pwd_card">Upload PWD Card</label>
                    </div>
                    <span class="err-pwd_card err-msg mb-4"></span>

                    @php
                        $pwd_card = str_replace('public', 'storage', auth()->user()->pwd_card);
                    @endphp

                    @if(!empty($pwd_card))
                        <img class="rounded border w-100 img-fluid img-preview" src="{{asset($pwd_card)}}" alt="PWD Card">
                    @endif
                    
                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="button" class="btn-update btn btn-primary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Save PWD Card</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('applicant.layouts.scripts')

    <script>
        $('.pwd_card').on('change', function(event) {
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
            formData.append('old_file', '{{auth()->user()->pwd_card}}');
            formData.append('pwd_card', $('#pwd_card')[0].files[0]);

            $.ajax({
                url: '{{ route('applicant.updatePWDCard') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                        toastr.success('PWD Card change successfully', 'Success')

                        setTimeout(function() {
                            window.location.href = '{{url('/applicant/pwd-card')}}'
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
