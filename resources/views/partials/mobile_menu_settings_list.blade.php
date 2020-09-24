<div class="mobile-menu__settings-list">
	<div class="mobile-menu__setting" data-mobile-menu-item>
		<button class="mobile-menu__setting-button" title="@lang('Language')" data-mobile-menu-trigger>
			<span class="mobile-menu__setting-icon">
				<img src="/images/languages/fr.png" alt="@lang('fr')">
			</span>
			<span class="mobile-menu__setting-title">
				@lang('fr')
			</span>
			<span class="mobile-menu__setting-arrow">
				@include('svg.mobile.arrow_right')
			</span>
		</button>
		<div class="mobile-menu__setting-panel" data-mobile-menu-panel>
			<div class="mobile-menu__panel mobile-menu__panel--hidden">
				<div class="mobile-menu__panel-header">
					<button class="mobile-menu__panel-back" type="button">
						@include('svg.mobile.arrow_left')
					</button>
					<div class="mobile-menu__panel-title">
						@lang('Language')
					</div>
				</div>
				<div class="mobile-menu__panel-body">
					<ul class="mobile-menu__links">
						<li data-mobile-menu-item>
							<button type="button" class="" data-mobile-menu-trigger>
								<div class="mobile-menu__links-image">
									<img src="/images/languages/en.png" alt="@lang('Flag')">
								</div>
								@lang('en')
							</button>
						</li>
						<li data-mobile-menu-item>
							<button type="button" class="" data-mobile-menu-trigger>
								<div class="mobile-menu__links-image">
									<img src="/images/languages/fr.png" alt="@lang('Flag')">
								</div>
								@lang('fr')
							</button>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
