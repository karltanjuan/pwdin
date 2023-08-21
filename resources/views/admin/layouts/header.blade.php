<div class="top">
	<i class="navToggle fa-solid fa-bars fa-icon"></i>
	<a class="profile" href="javascript:void(0)">
		@if (auth()->guard('admins')->user()->profile_photo != null)
			@php
				$profile_photo = str_replace('public', 'storage', auth()->guard('admins')->user()->profile_photo);
			@endphp
			<img src="{{asset($profile_photo)}}" alt="Profile Photo">
		@else
			<i class="fa-regular fa-user fa-icon"></i>
		@endif
	</a>
</div>