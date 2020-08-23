<div class="block block-brands block-brands--layout--columns-8-full">
	<div class="container">
		<ul class="block-brands__list">
			@foreach ($brands as $brand)
			<li class="block-brands__item">
				<a href="{{ route('brand', ['brand' => $brand]) }}" class="block-brands__item-link">
					<img src="{{ secure_asset('storage/' . $brand->logo) }}" alt="@lang('Photo')" loading="lazy">
					<span class="block-brands__item-name">{{ $brand->name }}</span>
				</a>
			</li>
			<li class="block-brands__divider" role="presentation"></li>
			@endforeach
		</ul>
	</div>
</div>
