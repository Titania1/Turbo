<!-- site__mobile-header -->
<header class="site__mobile-header">
	<div class="mobile-header">
		<div class="container">
			<div class="mobile-header__body">
				<button class="mobile-header__menu-button" type="button">
					@include('svg.mobile.menu_button')
				</button>
				<a class="mobile-header__logo" href="#">
					<!-- mobile-logo -->
					<img src="{{ secure_asset('storage/'.\Page::option('header')->logo) }}" alt="@lang('logo')"
						width="130" height="20">
				</a>
				<!-- mobile-logo / end -->
				<div class="mobile-header__search mobile-search">
					<form class="mobile-search__body">
						<input type="text" class="mobile-search__input" placeholder="Enter keyword or part number">
						<button type="button" class="mobile-search__vehicle-picker" aria-label="Select Vehicle">
							@include('svg.mobile.car')
							<span class="mobile-search__vehicle-picker-label">Vehicle
							</span>
						</button>
						<button type="submit" class="mobile-search__button mobile-search__button--search">
							@include('svg.mobile.search')
						</button>
						<button type="button" class="mobile-search__button mobile-search__button--close">
							@include('svg.X')
						</button>
						<div class="mobile-search__field">

						</div>
					</form>
				</div>
				<div class="mobile-header__indicators">
					<div class="mobile-indicator mobile-indicator--search d-md-none">
						<button type="button" class="mobile-indicator__button">
							<span class="mobile-indicator__icon">
								@include('svg.mobile.search')
							</span>
						</button>
					</div>
					<div class="mobile-indicator d-none d-md-block">
						<a href="/login" class="mobile-indicator__button">
							<span class="mobile-indicator__icon">
								<svg width="20" height="20">
									<path d="M20,20h-2c0-4.4-3.6-8-8-8s-8,3.6-8,8H0c0-4.2,2.6-7.8,6.3-9.3C4.9,9.6,4,7.9,4,6c0-3.3,2.7-6,6-6s6,2.7,6,6
	c0,1.9-0.9,3.6-2.3,4.7C17.4,12.2,20,15.8,20,20z M14,6c0-2.2-1.8-4-4-4S6,3.8,6,6s1.8,4,4,4S14,8.2,14,6z" />
								</svg>
							</span>
						</a>
					</div>
					<div class="mobile-indicator d-none d-md-block">
						<a href="/wishlist" class="mobile-indicator__button">
							<span class="mobile-indicator__icon">
								@include('svg.mobile.heart')
							</span>
						</a>
					</div>
					<div class="mobile-indicator"><a href="/cart" class="mobile-indicator__button"><span
								class="mobile-indicator__icon">
								@include('svg.mobile.shopping')
								<span class="mobile-indicator__counter">
									{{ Cart::count() }}
								</span>
							</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</header><!-- site__mobile-header / end -->
