@extends('applicant.layouts.master')

@section('title', 'Applicant - Change Resume')
@section('cover_page')
    <li class="breadcrumb-item text-white active">Settings</li>
    <li class="breadcrumb-item text-white active">Change Resume</li>
@endsection

@section('content')
    <style>
        
    </style>

    <h1 class="text-center mb-1 wow fadeInUp title-label" data-wow-delay="0.1s">Change Resume</h1>
    <p class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Unlock your dream job with an outstanding resume!</p>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    {{-- Resume --}}
                    <div class="input-group">
                        <input type="file" class="form-control form-control-lg resume" id="resume" tabindex="18"
                            accept=".pdf">
                        <label class="input-group-text" for="resume">Upload CV</label>
                    </div>
                    <span class="err-resume err-msg mb-4"></span>

                    @php
                        $resume = str_replace('public', 'storage', auth()->user()->resume);
                    @endphp
                    
                    <div class="text-center text-lg-start mt-4 pt-2">
                        @if(!empty($resume))
                            <a href="{{asset($resume)}}" target="_blank" type="button" class="btn btn-outline-secondary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">View resume</a>
                        @endif
                        <button type="button" class="btn-update btn btn-primary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Save Resume</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('applicant.layouts.scripts')

    <script>
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
                            toastr.success('Resume change successfully')

                            setTimeout(function() {
                                window.location.href = '{{url('/applicant/resume')}}'
                            }, 2000)
                        } else {
                            displayErrors(JSON.parse(response.errors));
                        }
                    },
                    error: function(xhr, status, error) {
                        var result = JSON.parse(xhr.responseText)
                        displayErrors(result.errors)
                    }
                });
            })
    </script>
@endsection
