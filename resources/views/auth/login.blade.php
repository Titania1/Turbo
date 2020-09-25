@extends('layouts.app')

@section('title', __('Login'))

@section('content')
<div class="block-space block-space--layout--after-header"></div>
<div class="container container--max-lg">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card flex-grow-1 mb-md-0">
				<div class="card-body">
					<h3 class="card-title">@lang('Login')</h3>
					<form method="POST" action="{{ route('login') }}" role="form">
						@csrf

						<div class="form-group row">
							<label for="email" class="col-md-4 col-form-label text-md-right">@lang('E-Mail Address') </label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">@lang('Password') </label>

							<div class="col-md-6">
								<input id="password" type="password" class="form-control" name="password" required
									autocomplete="current-password">
							</div>
						</div>
						<div>
							<div class="form-group row">
								<label for="Google" class="col-md-4 col-form-label text-md-right">@lang('Sign up with Google')
								</label>
								<div class="col-md-6">
									<a href="/login/google">
										@include('svg.google')
									</a>
								</div>
							</div>
							<div class="form-group row">
								<label for="Facebook" class="col-md-4 col-form-label text-md-right">@lang('Sign up with Facebook')
								</label>
								<div class="col-md-6">
									<a href="/login/facebook">
										@include('svg.facebook') </a>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6 offset-md-4">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="remember" id="remember"
											{{ old('remember') ? 'checked' : '' }}>
										<label class="form-check-label" for="remember">
											@lang('Remember Me')
										</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-0">
								<div class="col-md-8 offset-md-4">
									<button type="submit" class="btn btn-primary">
										@lang('Login')
									</button>
									<a class="btn btn-link" href="{{ route('password.request') }}">
										@lang('Forgot Your Password?')
									</a>
								</div>
								<div class="col-md-8 offset-md-4">
									<a class="btn btn-link" href="{{ route('register') }}">
										@lang('Create An Account')
									</a>
								</div>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
