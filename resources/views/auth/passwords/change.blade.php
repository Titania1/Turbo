@extends('layouts.app')

@section('title', __('Change Password'))

@section('content')
<div class="container container--max--xl">
	@if (session('message'))
	<div class="alert alert-success" role="alert">
		{{ session('message') }}
	</div>
	@endif
	<div class="row">
		<div class="col-12 col-lg-3 d-flex">
			@include('partials.account_navigation', ['active' => 'password'])
		</div>
		<div class="col-12 col-lg-9 mt-4 mt-lg-0">
			<div class="card">
				<div class="card-header">
					<h5>@lang('Change Password')</h5>
				</div>
				<div class="card-divider"></div>
				<div class="card-body card-body--padding--2">
					<div class="row no-gutters">
						<div class="col-12 col-lg-7 col-xl-6">
							<form action="{{ route('password.change') }}" method="post" role="form">
								@csrf
								<div class="form-group">
									<label for="password-new">@lang('New Password')</label>
									<input type="password" class="form-control" id="password-new"
										placeholder="@lang('New Password')" name="new_password"
										autocomplete="new-password" required>
								</div>
								<div class="form-group">
									<label for="password-confirm">@lang('Reenter New Password')</label>
									<input type="password" class="form-control" id="password-confirm"
										placeholder="@lang('Reenter New Password')" name="new_password_confirmation"
										autocomplete="new-password" required>
								</div>
								<div class="form-group mb-0">
									<button class="btn btn-primary mt-3" type="submit">@lang('Change')</button>
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
