<div class="header__indicators">
	<div class="indicator">
		<a href="{{ route('wishlist') }}" class="indicator__button">
			<span class="indicator__icon">
				@include('svg.wish')
			</span>
		</a>
	</div>
	<div class="indicator indicator--trigger--click @if($errors->has('email') && (url()->previous() != url('login'))) indicator--open @endif">
		<a href="/login" class="indicator__button">
			<span class="indicator__icon">
				@include('svg.account')
			</span>
			@guest
			<span class="indicator__title">@lang('Hello')</span>
			<span class="indicator__value">@lang('Login')</span>
			@else
			<span class="indicator__value">@lang('My Account')</span>
			<span class="indicator__title">{{ auth()->user()->name }}</span>
			@endguest
		</a>
		<div class="indicator__content">
			@include('partials.account_menu')
		</div>
	</div>
	@include('layouts.header.cart')
</div>
