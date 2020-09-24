<ul class="mobile-menu__links">
	<li data-mobile-menu-item>
		<a href="/" class="" data-mobile-menu-trigger>
			@lang('Home')
		</a>
	</li>
	<li data-mobile-menu-item>
		<a href="/shop-grid-4-columns-sidebar" class="" data-mobile-menu-trigger>
			@lang('Shop')
			@include('svg.arrow_right')
		</a>
		<div class="mobile-menu__links-panel" data-mobile-menu-panel>
			<div class="mobile-menu__panel mobile-menu__panel--hidden">
				<div class="mobile-menu__panel-header">
					<button class="mobile-menu__panel-back" type="button">
						@include('svg.arrow_left')
					</button>
					<div class="mobile-menu__panel-title">@lang('Shop')</div>
				</div>
				<div class="mobile-menu__panel-body">
					<ul class="mobile-menu__links">
						@foreach ($categories as $category)
						<li data-mobile-menu-item>
							<a href="{{ route('category', ['category' => $category]) }}" class="" data-mobile-menu-trigger>
								{{ $category->name }}
							</a>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</li>
	<li data-mobile-menu-item>
		<a href="/login" class="" data-mobile-menu-trigger>
			@lang('Account')
			@include('svg.arrow_right')
		</a>
		<div class="mobile-menu__links-panel" data-mobile-menu-panel>
			<div class="mobile-menu__panel mobile-menu__panel--hidden">
				<div class="mobile-menu__panel-header">
					<button class="mobile-menu__panel-back" type="button">
						@include('svg.arrow_left')
					</button>
					<div class="mobile-menu__panel-title">@lang('Account')</div>
				</div>
				<div class="mobile-menu__panel-body">
					<ul class="mobile-menu__links">
						@guest
						<li data-mobile-menu-item>
							<a href="/login" class="" data-mobile-menu-trigger>
								@lang('Login')
							</a>
						</li>
						<li data-mobile-menu-item>
							<a href="/register" class="" data-mobile-menu-trigger>
								@lang('Register')
							</a>
						</li>
						@else
						<li data-mobile-menu-item>
							<a href="/dashboard" class="" data-mobile-menu-trigger>
								@lang('Dashboard')
							</a>
						</li>
						<li data-mobile-menu-item>
							<a href="/shop" class="" data-mobile-menu-trigger>
								@lang('Shop')
							</a>
						</li>
						<li data-mobile-menu-item>
							<a href="/account/profile" class="" data-mobile-menu-trigger>
								@lang('Edit Profile')
							</a>
						</li>
						<li data-mobile-menu-item>
							<a href="/account/orders" class="" data-mobile-menu-trigger>
								@lang('Order History')
							</a>
						</li>
						<li data-mobile-menu-item>
							<a href="/account/addresses" class="" data-mobile-menu-trigger>
								@lang('Addresses')
							</a>
						</li>
						@endguest
					</ul>
				</div>
			</div>
		</div>
	</li>
</ul>
