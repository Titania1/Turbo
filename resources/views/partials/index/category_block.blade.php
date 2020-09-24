<div class="block-space block-space--layout--divider-lg"></div>
<div class="block block-zone">
	<div class="container">
		<div class="block-zone__body">
			@include('partials.categories_card')
			<div class="block-zone__widget">
				<div class="block-zone__widget-header">
					<div class="block-zone__tabs">
						<span class="block-zone__tabs-button block-zone__tabs-button--active">
							{{ $category->name }}
						</span>
					</div>
					<div class="arrow block-zone__arrow block-zone__arrow--prev arrow--prev">
						<button class="arrow__button" type="button">
							@include('svg.arrow_left')
						</button>
					</div>
					<div class="arrow block-zone__arrow block-zone__arrow--next arrow--next">
						<button class="arrow__button" type="button">
							@include('svg.arrow_right')
						</button>
					</div>
				</div>
				<div class="block-zone__widget-body">
					<div class="block-zone__carousel">
						<div class="block-zone__carousel-loader"></div>
						<div class="owl-carousel">
							@foreach ($category->subParts as $part)
							<div class="block-zone__carousel-item">
								<div class="product-card">
									@include('partials.part_card')
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--divider-sm"></div>
