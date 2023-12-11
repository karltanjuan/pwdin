@extends('employer.layouts.master')

@section('title', 'Employer Dashboard')

@section('content')
    <style>
        .dashboard-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            flex: 1;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }

        .card h3 {
            font-size: 40px;
        }

        .card1 { background-color: #FF7043; }
        .card2 { background-color: #4CAF50; }
        .card3 { background-color: #F44336; }
        .card4 { background-color: #2196F3; }
        .card5 { background-color: #9C27B0; }
        .card6 { background-color: #FFC107; }
    </style>

    <h1>Dashboard</h1>
    <br>
    <div class="dashboard-container">
        <div class="card card4">
            <a class="text-white" href="{{url('/employer/jobs')}}">
                <h3>{{$total_jobs}} <i class="fa-solid fa-briefcase"></i></h3>
                <p>Jobs</p>
            </a>
        </div>
        <div class="card card2">
            <a class="text-white" href="{{url('/employer/applicants/hired')}}">
                <h3>{{$total_hired}} <i class="fa-solid fa-handshake"></i></h3>
                <p>Hired</p>
            </a>
        </div>
        <div class="card card3">
            <a class="text-white" href="{{url('/employer/applicants/rejected')}}">
                <h3>{{$total_rejected}} <i class="fa-solid fa-face-frown"></i></h3>
                <p>Rejected</p>
            </a>
        </div>
    </div>
    <div class="dashboard-container">
        <div class="card card1">
            <a class="text-white" href="{{url('/employer/applicants')}}">
                <h3>{{$total_applicants}} <i class="fa-solid fa-people-line"></i></h3>
                <p>Applicants</p>
            </a>
        </div>
        <div class="card card5">
            <a class="text-white" href="{{url('/employer/jobs/open')}}">
                <h3>{{$total_jobs_open}} <i class="fa-solid fa-book-open"></i></h3>
                <p>Job Open</p>
            </a>
        </div>
        <div class="card card6">
            <a class="text-white" href="{{url('/employer/jobs/closed')}}">
                <h3>{{$total_jobs_closed}} <i class="fa-solid fa-circle-xmark"></i></h3>
                <p>Job Closed</p>
            </a>
        </div>
    </div>
    <div class="dashboard-container">
        <div class="card">
            <div class="pwd-chart" id="pwd-chart"></div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#pwd-chart").empty();

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
                resize: true,
                barColors: ['#428bca', '#d9534f', '#5cb85c', '#f0ad4e', '#5bc0de', '#337ab7']
            });
        })
    </script>
@endsection