@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

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
        .card7 { background-color: #3F51B5; }
        .card8 { background-color: #00BCD4; }
        .card9 { background-color: #8BC34A; }
        .card10 { background-color: #E91E63; }
        .card11 { background-color: #795548; }
        .card12 { background-color: #607D8B; }

        .w-50 {
            width: 50%;
        }

        .color-dark {
            color: #333;
        }
    </style>

    <h1>Dashboard</h1>
    <br>
    <div class="dashboard-container">
        <div class="card card4">
            <h3>{{$total_jobs}} <i class="fa-solid fa-briefcase"></i></h3>
            <p>Jobs</p>
        </div>
        <div class="card card1">
            <h3>{{$total_applicants}} <i class="fa-solid fa-people-line"></i></h3>
            <p>Applicants</p>
        </div>
        <div class="card card2">
            <h3>{{$total_hired}} <i class="fa-solid fa-handshake"></i></h3>
            <p>Hired</p>
        </div>
        <div class="card card3">
            <h3>{{$total_rejected}} <i class="fa-solid fa-rectangle-xmark"></i></h3>
            <p>Rejected</p>
        </div>
        <div class="card card5">
            <h3>{{$total_jobs_open}} <i class="fa-solid fa-book-open"></i></h3>
            <p>Job Open</p>
        </div>
        <div class="card card6">
            <h3>{{$total_jobs_closed}} <i class="fa-solid fa-book"></i></h3>
            <p>Job Closed</p>
        </div>
    </div>
    <div class="dashboard-container">
        <div class="card card7">
            <h3>{{$total_employer_approved}} <i class="fa-solid fa-thumbs-up"></i></h3>
            <p>Approved Employer</p>
        </div>
        <div class="card card8">
            <h3>{{$total_employer_pending}} <i class="fa-solid fa-clock-rotate-left"></i></h3>
            <p>Pending Employer</p>
        </div>
        <div class="card card9">
            <h3>{{$total_employer_rejected}} <i class="fa-solid fa-circle-xmark"></i></h3>
            <p>Rejected Employer</p>
        </div>
        <div class="card card10">
            <h3>{{$total_applicant_approved}} <i class="fa-solid fa-person-circle-check fa-icon"></i></h3>
            <p>Approved Applicant</p>
        </div>
        <div class="card card11">
            <h3>{{$total_applicant_pending}} <i class="fa-solid fa-hourglass-start fa-icon"></i></h3>
            <p>Pending Applicant</p>
        </div>
         <div class="card card12">
            <h3>{{$total_applicant_rejected}} <i class="fa-regular fa-circle-xmark"></i></h3>
            <p>Rejected Applicant</p>
        </div>
    </div>
    <div class="dashboard-container">
        <div class="card">
            <div class="pwd-chart" id="pwd-chart"></div>
        </div>
        <div class="card">
            <h4 class="color-dark">Applicant Gender</h4>
            <div class="gender-chart" id="gender-chart"></div>
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
                resize: true,
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