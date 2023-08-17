<div class="top">
	<i class="navToggle fa-solid fa-bars fa-icon"></i>
	<p>{{auth()->guard('employers')->user()->first_name}} {{auth()->guard('employers')->user()->middle_name}} {{auth()->guard('employers')->user()->last_name}}</p>
	<a class="profile" href="javascript:void(0)">
		@if (auth()->guard('employers')->user()->company_logo != null)
			@php
				$company_logo = str_replace('public', 'storage', auth()->guard('employers')->user()->company_logo);
			@endphp
			<img src="{{asset($company_logo)}}" alt="Company Logo">
		@else
			<i class="fa-regular fa-user fa-icon"></i>
		@endif
	</a>
</div>