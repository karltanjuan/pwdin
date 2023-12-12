@extends('admin.layouts.master')

@php $page_title = "Dashboard"; @endphp
@section('title', 'Admin - '.$page_title)

@section('content')
<style>

    .card {
        text-align: center;
        color:#fff;
    }

    .card1 { background-color: #FF7043; }
    .card2 { background-color: #4CAF50; }
    .card3 { background-color: #F44336; }
    .card4 { background-color: #2196F3; }
    .card5 { background-color: #9C27B0; }
    .card6 { background-color: #FFC107; }
    .card7 { background-color: #3F51B5; }
    .card8 { background-color: #00BCD4; }
    .card9 { background-color: #8BC34A; }
    .card10 { background-color: #E91E63; }
    .card11 { background-color: #795548; }
    .card12 { background-color: #607D8B; }

    .card h3 {
        font-size: 40px;
    }

    .card a {
        text-decoration: none;
    }
</style>
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-5">{{$page_title}}</h1>
    {{-- <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol> --}}
    <div class="row">
        <div class="col-md-3">
            <div class="card card4 mb-4">
                <div class="card-body">
                    <a class="text-white" href="{{url('admin/jobs')}}">
                        <h3>{{$total_jobs}} <i class="fa-solid fa-briefcase"></i></h3>
                        <p>Jobs</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card1 mb-4">
                <div class="card-body">
                    <a class="text-white" href="{{url('admin/applicants')}}">
                        <h3>{{$total_applicants}} <i class="fa-solid fa-people-line"></i></h3>
                        <p>Applicants</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card2 mb-4">
                <div class="card-body">
                    <a class="text-white" href="{{url('admin/applicants/hired')}}">
                        <h3>{{$total_hired}} <i class="fa-solid fa-handshake"></i></h3>
                        <p>Hired</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card3 mb-4">
                <div class="card-body">
                    <a class="text-white" href="{{url('admin/applicants/rejected')}}">
                        <h3>{{$total_rejected}} <i class="fa-solid fa-rectangle-xmark"></i></h3>
                        <p>Rejected</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card5 mb-4">
                <div class="card-body">
                    <a class="text-white" href="{{url('admin/jobs/open')}}">
                        <h3>{{$total_jobs_open}} <i class="fa-solid fa-book-open"></i></h3>
                        <p>Job Open</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card6 mb-4">
                <div class="card-body">
                    <a class="text-white" href="{{url('admin/jobs/closed')}}">
                        <h3>{{$total_jobs_closed}} <i class="fa-solid fa-book"></i></h3>
                        <p>Job Closed</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card7 mb-4">
                <div class="card-body">
                    <a class="text-white" href="{{url('admin/employers/approved')}}">
                        <h3>{{$total_employer_approved}} <i class="fa-solid fa-thumbs-up"></i></h3>
                        <p>Approved Employer</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card8 mb-4">
                <div class="card-body">
                    <a class="text-white" href="{{url('admin/employers/pending')}}">
                        <h3>{{$total_employer_pending}} <i class="fa-solid fa-clock-rotate-left"></i></h3>
                        <p>Pending Employer</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card9 mb-4">
                <div class="card-body">
                    <a class="text-white" href="{{url('admin/employers/rejected')}}">
                    <h3>{{$total_employer_rejected}} <i class="fa-solid fa-circle-xmark"></i></h3>
                    <p>Rejected Employer</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card10 mb-4">
                <div class="card-body">
                    <a class="text-white" href="{{url('admin/applicants/approved')}}">
                        <h3>{{$total_applicant_approved}} <i class="fa-solid fa-person-circle-check fa-icon"></i></h3>
                        <p>Approved Applicant</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card11 mb-4">
                <div class="card-body">
                    <a class="text-white" href="{{url('admin/applicants/pending')}}">
                        <h3>{{$total_applicant_pending}} <i class="fa-solid fa-hourglass-start fa-icon"></i></h3>
                        <p>Pending Applicant</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card12 mb-4">
                <div class="card-body">
                    <a class="text-white" href="{{url('admin/applicants/rejected')}}">
                        <h3>{{$total_applicant_rejected}} <i class="fa-regular fa-circle-xmark"></i></h3>
                        <p>Rejected Applicant</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="pwd-chart" id="pwd-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="color-dark">Applicant Gender</h4>
                    <div class="gender-chart" id="gender-chart"></div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
    $(document).ready(function() {
        $("#pwd-chart").empty();
        $('#gender-chart').empty();

        var pwd_categories = {!! json_encode($category_result) !!}

        Morris.Bar({
            element: 'pwd-chart',
            data: pwd_categories,
            xkey: ['category'],
            ykeys: ['count'],
            labels: ['PWD Categories Applied'],
            parseTime: false,
            hideHover: 'false',
            xLabelAngle: 60,
            resize: false,
            barColors: ['#428bca', '#d9534f', '#5cb85c', '#f0ad4e', '#5bc0de', '#337ab7']
        });

        var male_count = {!! json_encode($total_male) !!}
        var female_count = {!! json_encode($total_female) !!}
        var m = "#1E90FF", f = "#FF69B4"; 

        new Morris.Donut ({
            element: 'gender-chart',
            data: [
                {label: "\xa0 \xa0Male\xa0 \xa0", value: male_count, color: m},
                {label: "\xa0Female\xa0", value: female_count, color: f}
            ]
        });
    })
</script>

@endsection
