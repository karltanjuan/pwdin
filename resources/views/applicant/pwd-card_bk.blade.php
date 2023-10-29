@extends('applicant.layouts.master')

@section('title', 'Applicant Change PWD Card')

@section('content')
    <style>
        
    </style>
        <div class="content-0">
            <div class="head-container">
                <h1>Change PWD Card</h1>
            </div>
            <div id="form">
                <div class="form second" id="form-second">
                    <div class="details ID">
                        <div class="fields">
                            <div class="input-field">
                                <label>Upload PWD ID card / Recent medical records</label>
                                <input class="pwd_card" id="pwd_card" type="file" accept=".png,.jpeg,.jpg">
                                <span class="err-pwd_card err-msg"></span>
                            </div>
                            @php
                                $pwd_card = str_replace('public', 'storage', auth()->user()->pwd_card);
                            @endphp
                            <img class="img-flow-50 img-preview" src="{{asset($pwd_card)}}" alt="PWD Card">
                            <br><br>
                            <button class="primary-btn btn-update">Save PWD Card</button>
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

                            Swal.fire({
                              title: 'PWD Card change successfully',
                              text: '',
                              icon: 'success',
                              showCancelButton: false,
                              confirmButtonText: 'OK'
                            })

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