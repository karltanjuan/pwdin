<div class="top">
	<i class="navToggle fa-solid fa-bars fa-icon"></i>
	<p>{{auth()->user()->first_name}} {{auth()->user()->middle_name}} {{auth()->user()->last_name}}</p>
	<a class="profile" href="javascript:void(0)">
		@if (auth()->user()->profile_photo != null)
			@php
				$profile_photo = str_replace('public', 'storage', auth()->user()->profile_photo);
			@endphp
			<img src="{{asset($profile_photo)}}" alt="Profile Photo">
		@else
			<i class="fa-regular fa-user fa-icon"></i>
		@endif
	</a>
</div>