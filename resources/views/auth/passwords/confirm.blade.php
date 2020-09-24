@extends('layouts.app')

@section('title', __('Confirm Password'))

@section('content')
<div class="container container--max-lg">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card flex-grow-1 mb-md-0">
				<div class="card-body">
					<h3 class="card-title">@lang('Please confirm your password before continuing.')</h3>
					<form method="POST" action="{{ route('password.confirm') }}">
						@csrf

						<div class="form-group row">
							<label for="password"
								class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

							<div class="col-md-6">
								<input id="password" type="password"
									class="form-control @error('password') is-invalid @enderror" name="password"
									required autocomplete="current-password">

								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-primary">
									{{ __('Confirm Password') }}
								</button>
								<a class="btn btn-link" href="{{ route('password.request') }}">
									{{ __('Forgot Your Password?') }}
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
