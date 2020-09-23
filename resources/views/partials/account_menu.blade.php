<div class="account-menu">
	@auth
	<div class="account-menu__divider"></div>
	<a href="#" class="account-menu__user">
		<div class="account-menu__user-avatar">
			<img src="{{ auth()->user()->accountMenuAvatar }}" alt="@lang('Avatar')" width="40" height="40">
		</div>
		<div class="account-menu__user-info">
			<div class="account-menu__user-name">{{ auth()->user()->name }}</div>
			<div class="account-menu__user-email">{{ auth()->user()->email }}</div>
		</div>
	</a>
	<div class="account-menu__divider"></div>
	<ul class="account-menu__links">
		<li><a href="/dashboard">@lang('Dashboard')</a></li>
		<li><a href="/admin">@lang('Stock System')</a></li>
		<li><a href="{{ route('shop') }}">@lang('Shop')</a></li>
		<li><a href="{{ route('profile.edit') }}">@lang('Edit Profile')</a></li>
		<li><a href="/account-orders">@lang('Order History')</a></li>
		<li><a href="/account-addresses">@lang('Addresses')</a></li>
	</ul>
	<div class="account-menu__divider"></div>
	<ul class="account-menu__links">
		<li>
			<a href="{{ route('logout') }}"
				onclick="event.preventDefault();document.getElementById('logout-form').submit();">
				@lang('Logout')
			</a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
		</li>
	</ul>
	@else
	<form class="account-menu__form" method="POST" action="/login">
		@csrf
		<div class="account-menu__form-title">@lang('Log In to Your Account')</div>
		{{-- Email --}}
		<div class="form-group">
			<label for="header-signin-email" class="sr-only">
				@lang('Email address')
			</label>
			<input id="header-signin-email" type="email"
				class="form-control form-control-sm @error('email') is-invalid @enderror" name="email"
				value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="@lang('Email Address')">
			@error('email')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>
		{{-- Password --}}
		<div class="form-group">
			<label for="header-signin-password" class="sr-only">@lang('Password')</label>
			<div class="account-menu__form-forgot">
				<input id="header-signin-password" type="password" class="form-control form-control-sm"
					placeholder="@lang('Password')" name="password" required autocomplete="current-password">
				<a class="account-menu__form-forgot-link" href="{{ route('password.request') }}">
					@lang('Forgot?')
				</a>
			</div>
		</div>
		<div class="form-group">
			<div class="form-check">
				<input class="form-check-input" type="checkbox" name="remember" id="remember"
					{{ old('remember') ? 'checked' : '' }}>

				<label class="form-check-label" for="remember">
					@lang('Remember Me')
				</label>
			</div>
		</div>
		<div class="form-group account-menu__form-button">
			<button type="submit" class="btn btn-primary btn-sm">@lang('Login')</button>
		</div>
		<div class="account-menu__form-link">
			<a href="{{ route('register') }}">
				@lang('Create An Account')
			</a>
		</div>
	</form>
	@endauth
</div>
