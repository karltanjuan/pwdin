@extends('employer.layouts.master')

@section('title', 'Employer Application Status')

@section('content')
    <div class="head-container">
        <h1>Application Status</h1>
        <button class="btn-add primary-btn">
            <span><i class="fa-solid fa-plus"></i> Add Status</span>
        </button>
    </div>  

    <table class="status-table">
        <thead>
            <tr>
                <th>Order</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($app_status) > 0)
                @foreach ($app_status as $status)
                    @php
                        $statuses = json_decode($status->name);
                    @endphp
                    @foreach ($statuses as $status)

                        <tr>
                            <td>
                                <button>
                                    <i class="fa-solid fa-bars"></i>
                                </button>
                                <span>0</span>
                            </td>
                            <td> {{ $status }} </td>
                            <td>
                                <button class="btn-edit" id="btn-edit" data-name="{{ $status }}">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <button class="btn-delete" id="btn-delete" data-name="{{ $status }}">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            @else
                <tr>
                    <td></td>
                    <td class="text-center">No records found.</td>
                    <td></td>
                </tr>
            @endif
    </tbody>
    </table>
    
    <!-- modal -->
    <div id="modal-add-status" class="modal modal-add-status">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Add Status</h2>
                <span class="modal-close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="content">
                <div id="form">
                    <div class="form first" id="form-first">
                        <div class="details personal">
                            <div class="fields">
                                <div class="input-field">
                                    <label>Status Name</label>
                                    <input id="name" class="name" type="text" placeholder="Enter status name"/>
                                    <span class="err-name err-msg"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="primary-btn btn-save">Save</button>
                <button class="secondary-btn btn-cancel">Cancel</button>
            </div>
        </div>
    </div>

    <div id="modal-delete-status" class="modal modal-delete-status">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Delete Status</h2>
                <span class="modal-close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="content">
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button class="danger-btn btn-remove">Yes</button>
                    <button class="secondary-btn btn-cancel">No</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var name = "";
        $(document).ready(function() {
        })

        $(".check-all").click(function() {
            var isChecked = $(this).prop("checked");
            $("input[type='checkbox']").prop("checked", isChecked);
        });

        $("input[type='checkbox']:not(.check-all)").click(function() {
            var other_checkbox = ($("input[type='checkbox']:not(.check-all)").length === $("input[type='checkbox']:not(.check-all):checked").length);
            $(".check-all").prop("checked", other_checkbox);
        });

        function getAppStatusByName(name) {
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('name', name);

            // Send an AJAX request to validate the data
            $.ajax({    
                url: '{{ route('employer.getAppStatusByName') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('.name').val(response.status)
                },
                error: function(xhr, status, error) {
                    var result = JSON.parse(xhr.responseText)
                    console.log(result.errors)
                }
            });
        }

        $(document).on('click', '.btn-add', function() {
            $('.modal-title').text('Add Status')
            $('.btn-save').text('Save')

            $('.name').val('')
            $('.modal-add-status').show();
        })

        $(document).on('click', '.btn-edit', function() {
            $('.modal-title').text('Edit Status')
            $('.btn-save').text('Update')
            name = $(this).data('name')
            getAppStatusByName(name)
            $('.modal-add-status').show();
        })

        $(document).on('click', '.btn-delete', function() {
            name = $(this).data('name')
            $('.modal-delete-status').show();
        })

        $(document).on('click', '.btn-remove', function() {
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('name', name);

            // Send an AJAX request to validate the data
            $.ajax({
                url: '{{ route('employer.deleteAppStatus') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                        $('.modal').hide()

                        Swal.fire({
                          title: 'Application Status Deleted',
                          text: 'Success',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonText: 'OK'
                        });

                        setTimeout(function() {
                            window.location.href = '{{url('/employer/application-status')}}'
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

        function closeModal() {
            $(".modal").css("display", "none");
        }

        $(document).on('click', '.modal-close, .btn-cancel', function() {
            closeModal()
        })

        var datatable_job = $('.status-table').DataTable({
            "lengthChange": false,
            "iDisplayLength" : 10,
            // "order": [[0, 'asc']],
        });

        var err_counter = 0;
        function displayErrors(errors) {
            $('.err-msg').text('');
            $('.err-msg').siblings('input, select').removeClass('error');

            // loop all the error messages from backend to display on ui
            $.each(errors, function(field, messages) {
                var errMsgSelector = '.err-' + field;
                var inputSelector = '#' + field;
                $(errMsgSelector).text(messages[0]);
                $(inputSelector).addClass('error');
            });

            $("html, body").animate({ scrollTop: 0 }, "slow");
        }

        
        $('.btn-save').on('click', function() {
            // data to be uploaded on ajax
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('old_name', name);
            formData.append('name', $('#name').val());

            var url = '{{ route('employer.saveAppStatus') }}'

            if ($(this).text() == "Save") {
                event = "save"
            } else {
                event = "update"
            }

            // Send an AJAX request to validate the data
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                        $('.modal').hide()

                        var modal_title = "Application Status "
                        if (event == "save") {
                            modal_title += 'Created'
                        } else {
                            modal_title += 'Updated'
                        }

                        toastr.success(modal_title, 'Success')

                        setTimeout(function() {
                            window.location.href = '{{url('/employer/application-status')}}'
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