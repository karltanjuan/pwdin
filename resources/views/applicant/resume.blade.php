@extends('applicant.layouts.master')

@section('title', 'Applicant Change Resume')

@section('content')
    <style>
        
    </style>
        <div class="content-0">
            <div class="head-container">
                <h1>Change Resume</h1>
            </div>
            <div id="form">
                <div class="form second" id="form-second">
                    <div class="details ID">
                        <div class="fields">
                            <div class="input-field">
                                <label>Upload CV</label>
                                <input class="resume" id="resume" type="file" accept=".pdf">
                                <span class="err-resume err-msg"></span>
                            </div>
                            @php
                                $resume = str_replace('public', 'storage', auth()->user()->resume);
                            @endphp
                            <a href="{{asset($resume)}}" target="_blank">View Resume</a>
                            <br><br>
                            <button class="primary-btn btn-update">Save Resume</button>
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

        
            $('.btn-update').on('click', function() {
                var formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('old_file', '{{auth()->user()->resume}}');
                formData.append('resume', $('#resume')[0].files[0]);

                $.ajax({
                    url: '{{ route('applicant.updateResume') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.code == "200") {

                            Swal.fire({
                              title: 'Resume change successfully',
                              text: '',
                              icon: 'success',
                              showCancelButton: false,
                              confirmButtonText: 'OK'
                            })

                            setTimeout(function() {
                                window.location.href = '{{url('/applicant/resume')}}'
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