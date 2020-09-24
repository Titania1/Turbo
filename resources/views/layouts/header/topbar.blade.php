<div class="header__topbar-start-bg"></div>
<div class="header__topbar-start">
	<div class="topbar topbar--spaceship-start">
		<a class="topbar__item-text d-xxl-flex" href="tel:@option('header.phone')">
			@lang('Call Us'): @option('header.phone')
		</a>
		<div class="topbar__item-text">
			<a class="topbar__link" href="{{ route('contact') }}">
				@lang('Contact US')
			</a>
		</div>
	</div>
</div>
<div class="header__topbar-end-bg"></div>
<div class="header__topbar-end">
	<div class="topbar topbar--spaceship-end">
		<div class="topbar__item-text">
			<a class="topbar__link" href="{{ route('about') }}">
				@lang('About')
			</a>
		</div>
		<language-switcher />
	</div>
</div>
