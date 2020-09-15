<!-- mobile-menu -->
<div class="mobile-menu">
	<div class="mobile-menu__backdrop"></div>
	<div class="mobile-menu__body">
		<button class="mobile-menu__close" type="button">
			@include('svg.X')
		</button>
		<div class="mobile-menu__panel">
			<div class="mobile-menu__panel-header">
				<div class="mobile-menu__panel-title">@lang('Menu')</div>
			</div>
			<div class="mobile-menu__panel-body">
				@include('partials.mobile_menu_settings_list')
				<div class="mobile-menu__divider"></div>
				@include('partials.mobile_menu_indicators')
				<div class="mobile-menu__divider"></div>
				@include('partials.mobile_menu_links')
				<div class="mobile-menu__spring"></div>
				<div class="mobile-menu__divider"></div>
				<a class="mobile-menu__contacts" href="tel:@option('header.phone')">
					<div class="mobile-menu__contacts-subtitle">@lang('Call 24/7')</div>
					<div class="mobile-menu__contacts-title">
						@option('header.phone')
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
<!-- mobile-menu / end -->
