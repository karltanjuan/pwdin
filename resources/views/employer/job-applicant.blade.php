@extends('employer.layouts.master')

@php $page_title = "Applicant Details"; @endphp
@section('title', 'Employer - '.$page_title)
@section('cover_page')
    <li class="breadcrumb-item text-white">
        <a href="{{url('employer/jobs')}}">Job Post</a>
    </li>
    <li class="breadcrumb-item text-white">
        <a href="{{url('employer/jobs/'.request()->segment(3).'/applicants')}}">Applicants</a>
    </li>
    <li class="breadcrumb-item text-white active">{{$page_title}}</li>
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>

    <style>
        .select2-selection {
            min-height: 58px !important;
        }
    </style>

    <h1 class="text-center mb-5 wow fadeInUp title-label" data-wow-delay="0.1s">{{$page_title}}</h1>

    <div class="row wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
                @php
                    $profile_photo = str_replace('public', 'storage', $user->profile_photo);
                @endphp

                @if(!empty($profile_photo))
                    <img src="{{asset($profile_photo)}}" alt="avatar" class="rounded-circle img-fluid img-preview" style="width: 150px;height:150px;">
                @else
                    <img src="{{asset('/img/default_avatar.png')}}" alt="avatar" class="rounded-circle img-fluid img-preview" style="width: 150px;height:150px;">
                @endif

                <h5 class="my-3">{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}</h5>
                {{-- <p class="text-muted mb-1">Full Stack Developer</p> --}}
                <p class="text-muted mb-4">{{$user->city}}, {{$user->province}}</p>
            </div>
          </div>

            @php
                $pwd_card = str_replace('public', 'storage', $user->pwd_card);
                $resume = str_replace('public', 'storage', $user->resume);
            @endphp

            <ul class="list-group mb-4">
                <li class="list-group-item">
                    <a href="{{asset($resume)}}" target="_blank">
                        <i class="fa-solid fa-address-card"></i>
                        <span>View Resume</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="{{asset($resume)}}" target="_blank">
                        <i class="fa-solid fa-file"></i>
                        <span>View PWD Card</span>
                    </a>
                </li>
                {{-- <li class="list-group-item">
                    <a href="#" target="_blank">
                        <i class="fa-solid fa-certificate"></i>
                        <span>View Certificates</span>
                    </a>
                </li> --}}
            </ul>
        </div>
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                    <p>Username: <i>{{$user->username}}</i></p>
                </div>
                <div class="col-md-4">
                    <p>Email: <i>{{$user->email}}</i></p>
                </div>
                <div class="col-md-4">
                    <p>Mobile Number: <i>{{$user->mobile_no}}</i> </p>
                </div>
                <hr>
                <div class="col-md-4">
                    <p>Date of Birth: <i>{{$user->birthdate}}</i></p>
                </div>
                <div class="col-md-4">
                    <p>First Name: <i>{{$user->first_name}}</i></p>
                </div>
                <div class="col-md-4">
                    <p>Middle Name: <i>{{$user->middle_name}}</i></p>
                </div>
                <hr>
                <div class="col-md-4">
                    <p>Last Name: <i>{{$user->last_name}}</i></p>
                </div>
                <div class="col-md-4">
                    <p>Prefix: <i>{{$user->prefix}}</i></p>
                </div>
                <div class="col-md-4">
                    <p>Gender: <i>{{$user->gender}}</i></p>
                </div>
                <hr>
                <div class="col-md-4">
                    <p>Education Level: <i>{{$user->education_level}}</i></p>
                </div>
                <div class="col-md-4">
                    <p>Province: <i>{{$user->province}}</i></p>
                </div>
                <div class="col-md-4">
                    <p>City: <i>{{$user->city}}</i></p>
                </div>
                <hr>
                <div class="col-md-4">
                    <p>Address: <i>{{$user->address}}</i></p>
                </div>
                <div class="col-md-4">
                    <p>Zip Code: <i>{{$user->zip_code}}</i></p>
                </div>
                <hr>
                <div class="col-md-12">
                    <p>PWD Categories: <i>{{$user->pwd_categories}}</i></p>
                </div>
                <hr>
                <div class="col-md-12">
                    <p>Description: <i>{{$user->description}}</i></p>
                </div>
                <hr>
                <div class="col-md-12">
                    <label class="form-label" for="skills">Skills</label>
                    <input type="text" id="skills" class="form-control form-control-lg skills"
                        placeholder="Enter skills" tabindex="14" value="{{$user->skills}}" disabled="true"/>
                    <span class="err-skills err-msg"></span>
                </div>
                <hr>
                <div class="col-md-12">
                    
                    @if($user->applications[0]->is_rejected === 1)
                        <div class="mb-2">Rejected Reason: <i>{{$user->applications[0]->rejected_reason}}</i></div>
                    @endif
                    <div class="input-group">
                        @php 
                            $app_status = json_decode($app_status[0]->name);
                        @endphp
                        <select class="form-select status" id="status">
                            @foreach($app_status as $status)
                                @if($user->applications[0]->is_rejected === 1)
                                    <option value="{{$status}}" {{$status == 'Rejected' ? 'selected' : ''}}>{{$status}}</option>
                                @else
                                    <option value="{{$status}}" {{$user->applications[0]->status == $status ? 'selected' : ''}}>{{$status}}</option>
                                @endif
                            @endforeach
                        </select>
                        <button type="button" class="btn-modal btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Update Application</button>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>

    <!-- Modal -->
    <div class="modal fade updateModal" id="updateModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Application</h5>
                    <button type="button" class="close btn btn-secondary-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to continue?</p>
                    <div class="form-outline mb-4 form-floating rejected_reason_container">
                        <input type="text" id="rejected_reason" class="form-control form-control-lg rejected_reason"
                            placeholder="Enter job rejected_reason" tabindex="1" value="" />
                        <label class="form-label" for="rejected_reason">Rejected Reason</label>
                        <span class="err-rejected_reason err-msg"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary btn-confirm">Yes</button>
                </div>
            </div>
        </div>
    </div>
    
    @include('employer.layouts.scripts')

    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>

        $(document).ready(function() {
            const skills = document.querySelector('.skills');
            let choices = new Choices(skills, {
                removeItems: true,
                removeItemButton: true,
            });

            $('.err-rejected_reason').hide().text('')
            $('.rejected_reason_container').hide()
        });

        var is_rejected = 0;

        $(document).on('click', '.btn-modal', function() {
            $('.rejected_reason_container').hide()

            if ($('.status').val() == "Rejected") {
                $('.rejected_reason').val('')
                $('.rejected_reason_container').show()
            }

            $('.err-rejected_reason').hide().text('')

            $('#updateModal').modal('show')
        })

        $(document).on('click', '.close', function() {
            $('#updateModal').modal('hide')
        })

        let click_counter = 0;
        $(document).on('click', '.btn-confirm', function() {
            $('.err-rejected_reason').hide().text('')

            if ($('.status').val() == "Rejected") {
                if ($('.rejected_reason').val() == "") {
                    $('.rejected_reason').addClass('error')
                    $('.err-rejected_reason').show().text('Rejected reason field is required.')
                    return false;
                }

                is_rejected = 1;
            }

            $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`);

            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', '{{$user->applications[0]->id}}');
            formData.append('status', $('.status').val());
            formData.append('rejected_reason', $('.rejected_reason').val());
            formData.append('is_rejected', is_rejected);
            formData.append('job_id', '{{request()->segment(3)}}')
            formData.append('applicant_id', '{{request()->segment(5)}}')

            if (click_counter === 0) {
                click_counter++;
                $(this).prop('disabled', true);


                $.ajax({
                    url: '{{ route('employer.updateAppStatus') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.code == "200") {
                            $('.btn-confirm').html(`Yes`);
                            $('#updateModal').modal('hide')

                            toastr.success('Application Status Updated', 'Success')

                            setTimeout(function() {
                                window.location.href = '{{url('/employer/jobs/')}}/{{request()->segment(3)}}/applicants'
                            }, 2000)
                        } else {
                            displayErrors(JSON.parse(response.errors));
                            $('.btn-confirm').html(`Yes`).prop('disabled', false);
                            click_counter = 0;
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle the AJAX request error
                        var result = JSON.parse(xhr.responseText)
                        displayErrors(result.errors)
                        $('.btn-confirm').html(`Yes`).prop('disabled', false);
                        click_counter = 0;
                    }
                });
            }
        })
    </script>
@endsection
