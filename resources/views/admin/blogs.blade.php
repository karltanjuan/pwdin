@extends('admin.layouts.master')

@section('title', 'Admin - Blogs')

@section('content')
	<style>
		
	</style>

    <div class="head-container">
    	<h1>Blogs</h1>
    	<button class="btn-add primary-btn">
    		<span><i class="fa-solid fa-plus"></i> Add Blog</span>
    	</button>
    </div>	

	<table class="blogs-table">
		<thead>
			<tr>
				<th>Title</th>
				<th>Slug</th>
				<th>Excerpt</th>
				<th>Date Created</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@if (count($blogs) > 0)
				@foreach ($blogs as $blog)
				<tr>
					<td>{{ $blog->title }}</td>
					<td>{{ $blog->slug}}</td>
					<td>{{ $blog->excerpt}}</td>				
					<td>{{ date('m/d/y', strtotime($blog->created_at))}}</td>
					<td>
						<button class="btn-edit" id="btn-edit" data-id="{{ $blog->id }}">
							<i class="fa-regular fa-pen-to-square"></i>
						</button>
						<button class="btn-delete" id="btn-delete" data-id="{{ $blog->id }}">
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
	<div id="modal-add-blog" class="modal modal-add-blog">
		<!-- Modal content -->
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title">Save Blog</h2>
				<span class="modal-close">&times;</span>
			</div>
			<div class="modal-body">
				<div class="content">
				<div id="form">
					<div class="form first" id="form-first">
						<div class="details personal">
							<div class="fields">
								<div class="input-field">
									<label>Title</label>
									<input id="title" class="title" type="text" placeholder="Enter title"/>
									<span class="err-title err-msg"></span>
								</div>
								<div class="input-field">
									<label>Slug</label>
									<input id="slug" class="slug" type="text" placeholder="Enter slug" readonly/>
									<span class="err-slug err-msg"></span>
								</div>
								<div class="input-field">
									<label>Excerpt</label>
									<input id="excerpt" class="excerpt" type="text" placeholder="Enter excerpt"/>
									<span class="err-excerpt err-msg"></span>
								</div>
								<div class="input-field"></div>
							</div>
							<div class="input-field">
								<label>Body</label>
								<textarea rows="2" id="body" class="body" placeholder="Enter body">Enter blog body</textarea>
								<span class="err-body err-msg"></span>
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

	<div id="modal-delete-blog" class="modal modal-delete-blog">
		<div class="modal-content">
			<div class="modal-header">
				<h2>Delete Blog</h2>
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
			tinymce.init({
				selector: 'textarea#body',
				plugins: 'powerpaste advcode table image lists checklist emoticons',
				toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table | emoticons'
		   	});
			
		})

		$(document).on('click', '.btn-add', function() {
			$('.modal-title').text('Add Blog')
			$('.btn-save').text('Save')
			$('input, select').removeClass('error')
			$('.err-msg').text('')

			$('.title').val('')
			$('.slug').val('')
			$('.excerpt').val('')
			tinymce.get('body').setContent('');

			$('.modal-add-blog').show();
		})

		function slugify(text) {
	        return text.toString().toLowerCase()
	            .replace(/\s+/g, '-')
	            .replace(/[^\w\-]+/g, '')
	            .replace(/\-\-+/g, '-')
	            .replace(/^-+/, '')
	            .replace(/-+$/, '');
	    }

	    $("#title").on("keyup", function() {
	        var title_value = $(this).val();
	        var slug_value = slugify(title_value);
	        $("#slug").val(slug_value);
	    });

		function closeModal() {
            $(".modal").css("display", "none");
        }

        $(document).on('click', '.modal-close, .btn-cancel', function() {
            closeModal()
        })

		var datatable_job = $('.blogs-table').DataTable({
			"lengthChange": false,
			"iDisplayLength" : 10,
			"order": [[3, 'desc']],
		});

		function getBlogById(id) {
        	var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
        	formData.append('id', parseInt(id));

            $.ajax({
                url: '{{ route('admin.getBlogById') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                	var data = response.blog
	                $('#title').val(data.title);
	                $('#slug').val(data.slug);
	                $('#excerpt').val(data.excerpt);
	                tinymce.get('body').setContent(data.body);
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
			formData.append('title', $('#title').val());
			formData.append('slug', $('#slug').val());
			formData.append('excerpt', $('#excerpt').val());
			formData.append('body', tinymce.get("body").getContent());

			if ($(this).text() == "Save") {
	            var url = '{{ route('admin.saveBlog') }}'
	            event = "save"
	        } else {
	            var url ='{{ route('admin.updateBlog') }}'
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
                    		modal_title = 'Blog created successfully'
                    	} else {
                    		modal_title = 'Blog updated successfully'
                    	}

                        Swal.fire({
                          title: modal_title,
                          text: 'Success',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonText: 'OK'
                        });

                        setTimeout(function() {
                            window.location.href = '{{url('/admin/blogs')}}'
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
			$('.modal-title').text('Edit Blog')
			$('.btn-save').text('Update')
			id = $(this).data('id')
			$('.modal-add-blog').show();
			$('input, select').removeClass('error')
			$('.err-msg').text('')
			getBlogById(id)
		})


        $(document).on('click', '.btn-delete', function() {
			id = $(this).data('id')
			$('.modal-delete-blog').show();
		})

		$(document).on('click', '.btn-remove', function() {
			var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
        	formData.append('id', parseInt(id));

            $.ajax({
                url: '{{ route('admin.deleteBlog') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == "200") {
                    	$('.modal').hide()

                        Swal.fire({
                          title: 'Blog deleted successfully',
                          text: 'Success',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonText: 'OK'
                        });

                        setTimeout(function() {
                            window.location.href = '{{url('/admin/blogs')}}'
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