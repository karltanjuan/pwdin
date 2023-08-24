@extends('admin.layouts.master')

@section('title', 'Admin - Users')

@section('content')
	<style>
		.input-field {
            position: relative;
            display: inline-block;
        }

        .eye-icon-position1,
        .eye-icon-position2,
        .eye-icon-position3 {
            position: absolute;
            top: 60%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .user-preview {
        	border: 3px solid #44c7f5;
        	width: 200px;
        	height: 200px;
        	border-radius: 50%;
        }
		
	</style>

    <div class="head-container">
    	<h1>Users</h1>
    	<button class="btn-add primary-btn">
    		<span><i class="fa-solid fa-plus"></i> Add User</span>
    	</button>
    </div>	

	<table class="users-table">
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
					<td>
						<button class="btn-edit" id="btn-edit" data-id="{{ $user->id }}">
							<i class="fa-regular fa-pen-to-square"></i>
						</button>
						<button class="btn-delete" id="btn-delete" data-id="{{ $user->id }}">
							<i class="fa-regular fa-trash-can"></i>
						</button>
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
	
	<!-- modal -->
	<div id="modal-add-user" class="modal modal-add-user">
		<!-- Modal content -->
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title">Save User</h2>
				<span class="modal-close">&times;</span>
			</div>
			<div class="modal-body">
				<div class="content">
				<div id="form">
					<div class="form first" id="form-first">
						<div class="details personal">
							<div class="fields">
								<div class="input-field img-preview">
									<img class="user-preview" alt="Profile Photo"/>
								</div>
								<div class="input-field">
	                                <label>Profile Photo</label>
	                                <input class="profile_photo" id="profile_photo" type="file" accept=".png,.jpeg,.jpg">
	                                <span class="err-profile_photo err-msg"></span>
	                            </div>
								<div class="input-field">
									<label>Username</label>
									<input id="username" class="username" type="text" placeholder="Enter username"/>
									<span class="err-username err-msg"></span>
								</div>
								<div class="input-field">
									<label>Email</label>
									<input id="email" class="email" type="text" placeholder="Enter email"/>
									<span class="err-email err-msg"></span>
								</div>
								<div class="input-field">
									<label>Mobile Number</label>
									<input id="mobile_no" class="mobile_no" type="text" placeholder="Enter mobile number"/>
									<span class="err-mobile_no err-msg"></span>
								</div>
								<div class="input-field">
		                            <label>First Name</label>
		                            <input id="first_name" class="first_name" type="text" placeholder="Enter first name"/>
		                            <span class="err-first_name err-msg"></span>
		                        </div>
		                        <div class="input-field">
		                            <label>Middle Name</label>
		                            <input id="middle_name" class="middle_name" type="text" placeholder="Enter middle name"/>
		                            <span class="err-middle_name err-msg"></span>
		                        </div>
		                        <div class="input-field">
		                            <label>Last Name</label>
		                            <input id="last_name" class="last_name" type="text" placeholder="Enter last name"/>
		                            <span class="err-last_name err-msg"></span>
		                        </div>
		                        <div class="input-field">
		                            <label>Prefix</label>
		                            <input id="prefix" class="prefix" type="text" placeholder="Enter prefix"/>
		                            <span class="err-prefix err-msg"></span>
		                        </div>
								<div class="input-field">
		                            <label>Role</label>
		                            <select class="user-role" id="user-role">
		                            	{{-- <option value="" disabled selected>Select role</option> --}}
		                            	<option value="1">Admin</option>
		                            	<option value="2">Moderator</option>
		                            </select>
		                            <span class="err-role err-msg"></span>
		                        </div>
		                        <div class="input-field">
		                            <label>Status</label>
		                            <select class="status" id="status">
		                            	{{-- <option value="" disabled selected>Select status</option> --}}
		                            	<option value="0">Inactive</option>
		                            	<option value="1">Active</option>
		                            </select>
		                            <span class="err-role err-msg"></span>
		                        </div>
		                        <div class="input-field">
									<label>Password</label>
									<input id="password" class="password" type="password" placeholder="Enter password"/>
									<span class="show eye-icon-position1">
		                                <i class="las la-eye fs-5" id="show1" onclick="toggle1()"></i> 
		                            </span>
									<span class="err-password err-msg"></span>
								</div>
								<div class="input-field">
									<label>Confirm Password</label>
									<input id="password_confirmation" class="password_confirmation" type="password" placeholder="Enter password"/>
									<span class="show eye-icon-position2">
		                                <i class="las la-eye fs-5" id="show2" onclick="toggle2()"></i> 
		                            </span>
									<span class="err-password_confirmation err-msg"></span>
								</div>
								<div class="input-field"></div>
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

	<div id="modal-delete-user" class="modal modal-delete-user">
		<div class="modal-content">
			<div class="modal-header">
				<h2>Delete User</h2>
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
		var id = 0;
		$(document).ready(function() {
			
		})

		var state1 = false;
        var state2 = false;
        let hide1 = $("#show1");
        let hide2 = $("#show2");

        function toggle1() {
          if (state1) {
            $("#password").attr("type", "password");
            hide1.css("color", "#D0CECE");
            hide1.removeClass("la-eye-slash").addClass("la-eye");
            state1 = false;
          } else {
            $("#password").attr("type", "text");
            hide1.css("color", "#1976D2");
            hide1.removeClass("la-eye").addClass("la-eye-slash");
            state1 = true;
          }
        }

        function toggle2() {
          if (state2) {
            $("#password_confirmation").attr("type", "password");
            hide2.css("color", "#D0CECE");
            hide2.removeClass("la-eye-slash").addClass("la-eye");
            state2 = false;
          } else {
            $("#password_confirmation").attr("type", "text");
            hide2.css("color", "#1976D2");
            hide2.removeClass("la-eye").addClass("la-eye-slash");
            state2 = true;
          }
        }

		$(document).on('click', '.btn-add', function() {
			$('.modal-title').text('Add User')
			$('.btn-save').text('Save')
			$('input, select').removeClass('error')
			$('.err-msg').text('')
			$('.img-preview').hide()

			$('profile_photo').val('')
			$('.username').val('')
			$('.email').val('')
			$('.password').val('')
			$('.password_confirmation').val('')
			$('.mobile_no').val('')
			$('.first_name').val('')
			$('.middle_name').val('')
			$('.last_name').val('')
			$('.prefix').val('')
			$('.role').val(1)
            $('.status').val(1)

			$('.modal-add-user').show();
		})

		function closeModal() {
            $(".modal").css("display", "none");
        }

        $(document).on('click', '.modal-close, .btn-cancel', function() {
            closeModal()
        })

		var datatable_job = $('.users-table').DataTable({
			"lengthChange": false,
			"iDisplayLength" : 10,
			"order": [[0, 'desc']],
		});

		var old_file = ""
		function getUserById(id) {
        	var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
        	formData.append('id', parseInt(id));

            // Send an AJAX request to validate the data
            $.ajax({
                url: '{{ route('admin.getUserById') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                	var data = response.user
					$('#username').val(data.username);
	                $('#email').val(data.email);
	                $('#mobile_no').val(data.mobile_no);
	                $('#first_name').val(data.first_name);
	                $('#middle_name').val(data.middle_name);
	                $('#last_name').val(data.last_name);
	                $('#prefix').val(data.prefix);
	                $('#user-role').val(data.role);
	                $('#status').val(data.status);
	                old_file = data.profile_photo

	                if (old_file !== null && old_file !== undefined) {
	                	let result = old_file.replace('public', 'storage')
	                	var url = `{{url('/')}}`
	                	$('.img-preview').show()
						$('.user-preview').attr('src', `${url}/${result}`)
	                } else {
	                	$('.img-preview').hide()
	                }
                },
                error: function(xhr, status, error) {
                    var result = JSON.parse(xhr.responseText)
                    console.log(result.errors)
                }
            });
        }


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
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', id);
            formData.append('old_file', old_file);
            formData.append('profile_photo', $('#profile_photo')[0].files[0]);
            formData.append('username', $('#username').val());
			formData.append('email', $('#email').val());
			formData.append('mobile_no', $('#mobile_no').val());
			formData.append('first_name', $('#first_name').val());
			formData.append('middle_name', $('#middle_name').val());
			formData.append('last_name', $('#last_name').val());
			formData.append('prefix', $('#prefix').val());
			formData.append('password', $('#password').val());
			formData.append('password_confirmation', $('#password_confirmation').val());
			formData.append('role', $('#user-role').val());
			formData.append('status', $('#status').val());

			if ($(this).text() == "Save") {
	            var url = '{{ route('admin.saveUser') }}'
	            event = "save"
	        } else {
	            var url ='{{ route('admin.updateUser') }}'
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

                    	var modal_title = ""
                    	if (event == "save") {
                    		modal_title = 'User created successfully'
                    	} else {
                    		modal_title = 'User updated successfully'
                    	}

                        Swal.fire({
                          title: modal_title,
                          text: 'Success',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonText: 'OK'
                        });

                        setTimeout(function() {
                            window.location.href = '{{url('/admin/users')}}'
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

        $(document).on('click', '.btn-edit', function() {
			$('.modal-title').text('Edit User')
			$('.btn-save').text('Update')
			id = $(this).data('id')
			$('.modal-add-user').show();
			$('input, select').removeClass('error')
			$('.err-msg').text('')
			getUserById(id)
		})


        $(document).on('click', '.btn-delete', function() {
			id = $(this).data('id')
			$('.modal-delete-user').show();
		})

		$(document).on('click', '.btn-remove', function() {
			var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
        	formData.append('id', parseInt(id));

            $.ajax({
                url: '{{ route('admin.deleteUser') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                    	$('.modal').hide()

                        Swal.fire({
                          title: 'User deleted successfully',
                          text: 'Success',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonText: 'OK'
                        });

                        setTimeout(function() {
                            window.location.href = '{{url('/admin/users')}}'
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