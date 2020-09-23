@extends('layouts.app')

@section('title', __('Register'))

@section('block')
<div class="container container--max-lg">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card flex-grow-1 mb-md-0">
				<div class="card-body">
					<h3 class="card-title">@lang('Register')</h3>
					<form method="POST" action="{{ route('register') }}">
						@csrf

						<div class="form-group row">
							<label for="name" class="col-md-4 col-form-label text-md-right">@lang('Name')</label>

							<div class="col-md-6">
								<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

								@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="email" class="col-md-4 col-form-label text-md-right">@lang('E-Mail Address') </label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">@lang('Password')</label>

							<div class="col-md-6">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password-confirm" class="col-md-4 col-form-label text-md-right">
								@lang('Confirm Password')
							</label>

							<div class="col-md-6">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
							</div>
						</div>

						<div class="form-group row">
							<label for="Google" class="col-md-4 col-form-label text-md-right">
								@lang('Sign up with Google')
							</label>
							<div class="col-md-6">
								<a href="/login/google">
									@include('svg.google')
								</a>
							</div>
						</div>
						<div class="form-group row">
							<label for="Facebook" class="col-md-4 col-form-label text-md-right">
								@lang('Sign up with Facebook')
							</label>
							<div class="col-md-6">
								<a href="/login/facebook">
									@include('svg.facebook')
								</a>
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary">
									@lang('Register')
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
