@extends('applicant.layouts.master')

@section('title', 'Applicant - Job Details')
@section('cover_page')
    <li class="breadcrumb-item text-white">
        <a href="{{ url('/applicant/jobs') }}">Job List</a>
    </li>
    <li class="breadcrumb-item text-white active">Job Details</li>
@endsection
@section('content')
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gy-5 gx-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-5">
                    @php  $company_logo = str_replace('public', 'storage', $job->employer->company_logo) @endphp
                    <img class="flex-shrink-0 img-fluid border rounded" src="{{asset($company_logo)}}" alt="" style="width: 80px; height: 80px;">
                    <div class="text-start ps-4">
                        <h3 class="mb-3">{{$job->job_title}}</h3>
                        <span class="text-truncate me-3">
                            <i class="fa fa-map-marker-alt text-primary me-2"></i>
                            {{$job->employer->address}}, {{$job->employer->city}}, {{$job->employer->province}}, {{$job->employer->zip_code}}
                        </span>
                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{$job->job_type}}</span>
                        <span class="text-truncate me-0">
                            <i class="far fa-money-bill-alt text-primary me-2"></i>&#8369;
                            @if($job->hide_salary === 1)
                                @php
                                    $salaryLength = strlen($job->salary);
                                    $hiddenSalary = str_repeat('*', $salaryLength);
                                @endphp
                                {{ $hiddenSalary }}
                            @else
                                @php $formattedSalary = number_format($job->salary, 2) @endphp
                                {{ $formattedSalary }}
                            @endif
                        </span>
                    </div>
                </div>

                <div class="mb-5">
                    <h4 class="mb-3">Job description</h4>
                    <div class="job-desription">
                        {!!$job->job_description!!}
                    </div>
                    <h4 class="mb-3">Other Details</h4>
                    <p>Magna et elitr diam sed lorem. Diam diam stet erat no est est. Accusam sed lorem stet voluptua sit sit at stet consetetur, takimata at diam kasd gubergren elitr dolor</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-angle-right text-primary me-2"></i>PWD Categories: <i>{{$job->pwd_categories}}</i></li>
                        <li><i class="fa fa-angle-right text-primary me-2"></i>Working Days: <i>{{$job->working_days}}</i></li>
                        <li><i class="fa fa-angle-right text-primary me-2"></i>Career Level: <i>{{$job->career_level}}</i></li>
                        <li><i class="fa fa-angle-right text-primary me-2"></i>Years of Experience: <i>{{$job->years_experience}}</i></li>
                        <li><i class="fa fa-angle-right text-primary me-2"></i>Job Industry: <i>{{$job->job_industry}}</i></li>
                        <li><i class="fa fa-angle-right text-primary me-2"></i>Qualification: <i>{{$job->qualification}}</i></li>
                        <li><i class="fa fa-angle-right text-primary me-2"></i>Work Setup: <i>{{$job->work_setup}}</i></li>
                        
                    </ul>
                </div>

                <div class="">
                    @if(count($job->applications) > 0)
                        @if($job->applications[0]->status == 'Withdrawn')
                            <h4 class="mb-4">Apply For The Job</h4>
                        @else
                            <h4 class="mb-4">Withdraw This Job</h4>
                        @endif
                    @else
                        <h4 class="mb-4">Apply For The Job</h4>
                    @endif
                    <div class="row g-3">
                        @if(count($job->applications) > 0)
                            @if($job->applications[0]->status == 'Withdrawn')
                                <div class="col-12">
                                    <label for="cover_letter">Enter cover letter</label>
                                    <textarea class="form-control cover_letter" id="cover_letter" rows="10" placeholder="Cover letter"></textarea>
                                    <span class="err-cover_letter err-msg"></span>
                                </div>
                            @endif
                        @else
                            <div class="col-12">
                                <label for="cover_letter">Enter cover letter</label>
                                <textarea class="form-control cover_letter" id="cover_letter" rows="10" placeholder="Cover letter"></textarea>
                                <span class="err-cover_letter err-msg"></span>
                            </div>
                        @endif
                        <div class="col-12">
                            @if(count($job->applications) > 0 && $job->applications[0]->status != 'Withdrawn')
                                <button class="btn btn-primary btn-lg w-100 btn-withdraw" type="button">Withdraw</button>
                            @else
                                <button class="btn btn-primary btn-lg w-100 btn-apply" type="button">Apply Now</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                    <h4 class="mb-4">Job Summary</h4>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Published On: {{date('m/d/Y', strtotime($job->created_at))}}</p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Vacancy: {{$job->status === 1 ? 'Open' : 'Closed'}}</p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Job Nature: {{$job->job_type}}</p>
                    <p>
                        <i class="fa fa-angle-right text-primary me-2"></i>Salary:
                        @if($job->hide_salary === 1)
                            @php
                                $salaryLength = strlen($job->salary);
                                $hiddenSalary = str_repeat('*', $salaryLength);
                            @endphp
                            &#8369;{{ $hiddenSalary }}
                        @else
                            @php $formattedSalary = number_format($job->salary, 2) @endphp
                            &#8369;{{ $formattedSalary }}
                        @endif
                    </p>
                    <p>
                        <i class="fa fa-angle-right text-primary me-2"></i>
                        {{$job->employer->address}}, {{$job->employer->city}}, {{$job->employer->province}}, {{$job->employer->zip_code}}
                    </p>
                </div>
                <div class="bg-light rounded p-5 wow slideInUp" data-wow-delay="0.1s">
                    <h4 class="mb-4">Company Detail</h4>
                    <p class="m-0 text-justify">{{$job->employer->summary}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    })

    $(document).on('click', '.btn-apply', function() {
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('cover_letter', $('.cover_letter').val())
        formData.append('job_id', parseInt('{{request()->segment(3)}}'));

        $.ajax({
            url: '{{ route('applicant.applyJob') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.code == "200") {
                    toastr.success('Application submitted', 'Success')

                    setTimeout(function() {
                        window.location.href = '{{ url('/applicant/jobs') }}'
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

    $(document).on('click', '.btn-withdraw', function() {
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('job_id', parseInt('{{request()->segment(3)}}'));

        $.ajax({
            url: '{{ route('applicant.withdrawJob') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.code == "200") {
                    toastr.success('Application withdraw', 'Success')

                    setTimeout(function() {
                        window.location.href = '{{ url('/applicant/jobs') }}'
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