<div class="header__logo">
	<a href="/" class="logo">
		<div class="logo__slogan">
			<p>
				{{ \Page::option('header')->slogan[app()->getLocale()] }}
			</p>
		</div>
		<div class="logo__image">
			<img src="{{ secure_asset('storage/'.\Page::option('header')->logo) }}" alt="@lang('logo')" width="168"
				height="26">
		</div>
	</a>
</div>
