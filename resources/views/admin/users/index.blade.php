@extends('admin.layouts.master')

@php $page_title = "Users"; @endphp
@section('title', 'Admin - '.$page_title)

@section('content')
<link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
<style>
    .eye-icon-position {
        display: flex;
        float: right;
        margin-top: -38px;
        margin-right: 12px;
    }

    .err-msg {
        color: red;
        font-size: 12px;
        display: flex;
    }

    .error {
        border: 1px solid red !important;
    }

    .btn-add {
        margin-left: 210px;
    }
</style>
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-5">{{$page_title}}</h1>
    
    <div class="row mb-5">
        <div class="col-md-12">
            <a href="{{ url('admin/users/add') }}" class="btn btn-primary mb-5 mt-0 position-absolute btn-add">Add User</a>
            <table class="table table-bordered table-striped users-table" id="users-table">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                {{ $user->first_name }}
                                {{ $user->last_name }}
                            </td>
                            <td>
                                @switch($user->role)
                                    @case(1)
                                        <span>Admin</span>
                                        @break
                                    @case(2)
                                        <span>Moderator</span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                @switch($user->status)
                                    @case(0)
                                        <span>Inactive</span>
                                        @break
                                    @case(1)
                                        <span>Active</span>
                                        @break
                                @endswitch
                            </td>
                            <td>{{ date('m/d/y', strtotime($user->created_at))}}</td>
                            <td class="text-center">
                                <a href="{{ url('admin/users/edit/' . $user->id) }}" title="Edit User"
                                    class="btn btn-outline-primary btn-sm btn-edit" id="btn-edit"
                                    data-id="{{ $user->id }}">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <a href="javascript:void(0)" title="Delete User" class="btn btn-outline-danger btn-sm btn-delete"
                                    id="btn-delete" data-id="{{ $user->id }}" data-bs-toggle="modal"
                                    data-bs-target="#modal-delete-user" role="dialog">
                                    <i class="fa-regular fa-trash-can"></i>
                                </a
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-center">No records found.</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif
            </tbody>
            </table>
        </div>
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade modal-delete-user" id="modal-delete-user" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger btn-remove">Confirm</button>
                </div>
            </div>
        </div>
    </div>


<script src="{{asset('lib/wow/wow.min.js')}}"></script>
<script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    window.addEventListener('DOMContentLoaded', event => {
        const datatablesSimple = document.getElementById('users-table');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });

    let id = 0;
    $(document).on('click', '.btn-delete', function() {
            id = $(this).data('id')
            $('.modal-delete-user').show();
        })

        let click_counter = 0;

        $(document).on('click', '.btn-remove', function() {
            $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`);

            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', id);

            if (click_counter === 0) {
                click_counter++;
                $(this).prop('disabled', true);

                $.ajax({
                    url: '{{ route('admin.deleteUser') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.code == "200") {
                            $('.btn-remove').html(`Confirm`);
                            $('.modal').modal('hide')

                            toastr.success('User deleted successfully', 'Success')

                            setTimeout(function() {
                                window.location.href = '{{url('/admin/users')}}'
                            }, 2000)
                        } else {
                            displayErrors(JSON.parse(response.errors));
                            $('.btn-remove').html(`Confirm`).prop('disabled', false);
                            click_counter = 0;
                        }
                    },
                    error: function(xhr, status, error) {
                        var result = JSON.parse(xhr.responseText)
                        displayErrors(result.errors)
                        $('.btn-remove').html(`Confirm`).prop('disabled', false);
                        click_counter = 0;
                    }
                });
            }
        })
</script>

@endsection
