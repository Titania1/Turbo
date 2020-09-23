@extends('layouts.app')

@section('title', __('Edit Profile'))

@section('block')
<div class="container container--max--xl">
	<div class="row">
		<div class="col-12 col-lg-3 d-flex">
			@include('partials.account_navigation', ['active' => 'profile'])
		</div>
		<div class="col-12 col-lg-9 mt-4 mt-lg-0">
			<div class="card">
				<div class="card-header">
					<h5>@lang('Edit Profile')</h5>
				</div>
				<div class="card-divider"></div>
				<div class="card-body card-body--padding--2">
					<div class="row no-gutters">
						<div class="col-12 col-lg-7 col-xl-6">
							@if ($errors->profile->any())
								<div class="alert alert-danger">
									<ul>
										@foreach ($errors->profile->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif
							@if (session('status'))
								<div class="alert alert-success">
									{{ session('status') }}
								</div>
							@endif
							<form action="{{ route('profile.update', ['profile' => $profile]) }}" method="POST" role="form">
								@csrf
								<div class="form-group">
									<label for="profile-name">
										@lang('Your Name')
									</label>
									<input type="text" class="form-control @error('name', 'profile') is-invalid @enderror" id="profile-name" name="name" placeholder="@lang('Your Name')" required autofocus value="{{ auth()->user()->name }}">
									@error('name', 'profile')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group">
									<label for="profile-email">
										@lang('Email Address')
									</label>
									<input type="email" class="form-control @error('email', 'profile') is-invalid @enderror" id="profile-email" name="email" placeholder="@lang('Email Address')" required value="{{ auth()->user()->email }}">
									@error('email', 'profile')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="form-group">
									<label for="profile-phone">
										@lang('Phone Number')
									</label>
									<input type="tel" class="form-control @error('phone', 'profile') is-invalid @enderror" id="profile-phone" name="phone" placeholder="@lang('Phone Number')" maxlength="10" pattern="(0)(5|6|7)(4|5|6|7)[0-9]{7}" value="{{ optional($profile)->phone }}">
									@error('phone', 'profile')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="form-group mb-0">
									<button class="btn btn-primary mt-3" type="submit" role="button">
										@lang('Save')
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
