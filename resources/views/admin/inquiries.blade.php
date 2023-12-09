@extends('admin.layouts.master')

@php $page_title = "Inquiries"; @endphp
@section('title', 'Admin - '.$page_title)

@section('content')
<style>
    .total_today {
        background: rgb(0, 222, 137);
        cursor:  pointer;
        border: none;
    }

    .total_last_week {
        background: rgb(0, 190, 215);
        cursor:  pointer;
        border: none;
    }

    a {
        text-decoration: none;
    }
</style>

<div class="container-fluid px-4">
    <h1 class="mt-4 mb-5">{{$page_title}}</h1>
    <div class="row mb-5">
        <div class="col-md-10">
            <table class="table table-bordered table-striped inquiries-table" id="inquiries-table">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Subject</th>
                        <th>Inquiry Details</th>
                        <th>Date Created</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($inquiries) > 0)
                            @foreach ($inquiries as $inquiry)
                            <tr>
                                <td>{{ $inquiry->full_name }}</td>
                                <td><a class="text-primary btn-outline-primary" href="mailto:{{ $inquiry->email_address }}">{{ $inquiry->email_address }}</a></td>
                                <td>{{ $inquiry->subject }}</td>
                                <td class="text-justify" data-id="{{$inquiry->id}}">
                                    <span class="view-message" data-message="{{$inquiry->message}}" style="cursor:pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="View Message">
                                        {{ (strlen($inquiry->message) > 50) ? substr($inquiry->message, 0, 50) . '...' : $inquiry->message }}
                                    </span>
                                </td>
                                <td>{{ date('m/d/y', strtotime($inquiry->created_at))}}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">No records found.</td>
                            </tr>
                        @endif
                </tbody>
            </table>
        </div>
        <div class="col-md-2">
            <a href="{{ url('/admin/inquiries/today') }}">
                <div class="card total_today mb-4 mt-0 me-5">
                    <div class="card-body count ps-0 pe-0">
                        <h3 class="card-title text-white text-center pt-3">{{ $today_count }}</h3>
                        <p class="card-text text-white text-center pt-2 pb-2">Total Today</p>
                    </div>
                </div>
            </a>
            <a href="{{ url('/admin/inquiries/last-week') }}">
                <div class="card total_last_week mb-3 mt-3 me-5">
                    <div class="card-body count ps-0 pe-0">
                        <h3 class="card-title text-white text-center pt-3">{{ $last_week_count }}</h3>
                        <p class="card-text text-white text-center pt-2 pb-2">Total Last Week</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<script>
    window.addEventListener('DOMContentLoaded', event => {
        const datatablesSimple = document.getElementById('inquiries-table');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });

    $(document).on('click', '.view-message', function() {
        var message = $(this).data("message");
        if (!message) {
            var trimmed_message = $(this).text().slice(0, -3);
            $(this).data("message", trimmed_message);
            $(this).text(trimmed_message);
        } else {
            $(this).removeAttr("data-message");
            $(this).text(message);
        }
    });

</script>
@endsection
