<div class="account-nav flex-grow-1">
	<h4 class="account-nav__title">@lang('Navigation')</h4>
	<ul class="account-nav__list">
		<li class="account-nav__item @if($active == 'dashboard') account-nav__item--active @endif">
			<a href="{{ route('home') }}">@lang('Dashboard')</a>
		</li>
		<li class="account-nav__item">
			<a href="/admin">@lang('Stock System')</a>
		</li>
		<li class="account-nav__item @if($active == 'shop') account-nav__item--active @endif">
			<a href="{{ route('shop') }}">@lang('Shop')</a>
		</li>
		{{-- <li class="account-nav__item @if($active == 'garage') account-nav__item--active @endif">
			<a href="{{ route('garage') }}">@lang('Garage')</a>
		</li> --}}
		<li class="account-nav__item @if($active == 'profile') account-nav__item--active @endif">
			<a href="{{ route('profile.edit') }}">@lang('Edit Profile')</a>
		</li>
		<li class="account-nav__item @if($active == 'orders') account-nav__item--active @endif">
			<a href="/orders">@lang('Order History')</a>
		</li>
		<li class="account-nav__item @if($active == 'address') account-nav__item--active @endif">
			<a href="/addresses">@lang('Addresses')</a>
		</li>
		<li class="account-nav__item @if($active == 'password') account-nav__item--active @endif">
			<a href="/account/password">@lang('Password')</a>
		</li>
		<li class="account-nav__divider" role="presentation"></li>
		<li class="account-nav__item">
			<a href=" {{ route('logout') }}"
				onclick="event.preventDefault();document.getElementById('logout-navigation-form').submit();">
				@lang('Logout')
			</a>
			<form id="logout-navigation-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
		</li>
	</ul>
</div>
