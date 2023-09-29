@extends('employer.layouts.master')

@section('title', 'Employer Change BIR Certificate')

@section('content')
    <style>
        
    </style>
        <div class="content-0">
            <div class="head-container">
                <h1>Change BIR Certificate</h1>
            </div>
            <div id="form">
                <div class="form second" id="form-second">
                    <div class="details ID">
                        <div class="fields">
                            <div class="input-field">
                                <label>Upload BIR Certificate</label>
                                <input class="bir_certificate" id="bir_certificate" type="file" accept=".pdf,.png,.jpeg,.jpg">
                                <span class="err-bir_certificate err-msg"></span>
                            </div>
                            @php
                                $bir_certificate = str_replace('public', 'storage', auth()->guard('employers')->user()->bir_certificate);

                                $path = pathinfo($bir_certificate);
                            @endphp
                            

                            <div class="preview-container">
                                @if (isset($path['extension']) && $path['extension'] == "pdf")
                                    <a href="{{asset($bir_certificate)}}" target="_blank">View and Download</a>
                                @else
                                    <img class="img-flow-50 img-preview" src="{{asset($bir_certificate)}}" alt="BIR Certificat">
                                @endif
                            </div>
                            
                            <button class="primary-btn btn-update">Save BIR Certificate</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var err_counter = 0;
            function displayErrors(errors) {
                $('.err-msg').text('');
                $('.error').css('border', 'none')
                $('.err-msg').siblings('input').removeClass('error');

                // loop all the error messages from backend to display on ui
                $.each(errors, function(field, messages) {
                    var errMsgSelector = '.err-' + field;
                    var inputSelector = '#' + field;
                    $(errMsgSelector).text(messages[0]);
                    $(inputSelector).addClass('error');
                });
            }

            $('.bir_certificate').on('change', function(event) {
                const selectedImage = event.target.files[0];
                var extension = selectedImage.name.split('.').pop().toLowerCase();

                if (extension != "pdf") {
                    $('.preview-container').html(`<img class="img-flow-50 img-preview" alt="BIR Certificate"/>`)
                
                    if (selectedImage) {
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            $('.img-preview').attr('src', e.target.result);
                        };
                        
                        reader.readAsDataURL(selectedImage);
                    }
                } else {
                    $('.img-preview').hide()
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

                            Swal.fire({
                              title: 'BIR Certificate change successfully',
                              text: '',
                              icon: 'success',
                              showCancelButton: false,
                              confirmButtonText: 'OK'
                            })

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