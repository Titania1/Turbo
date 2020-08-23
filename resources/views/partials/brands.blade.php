<div class="block block-brands block-brands--layout--columns-8-full">
	<div class="container">
		<div class="product__tabs product-tabs">
			<ul class="product-tabs__list">
				<li class="product-tabs__item product-tabs__item--active">
					<a href="#passenger_brands">
						Véhicules de Tourisme
					</a>
				</li>
				<li class="product-tabs__item">
					<a href="#commercial_brands">
						Bus et Véhicules Utilitaires
					</a>
				</li>
			</ul>
			<div class="product-tabs__content">
				<div class="product-tabs__pane product-tabs__pane--active" id="passenger_brands">
					<ul class="block-brands__list">
						@foreach($brands as $brand)
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
				<div class="product-tabs__pane" id="commercial_brands">
					<ul class="block-brands__list">
						@foreach($commercial_brands as $brand)
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
		</div>
	</div>
</div>
