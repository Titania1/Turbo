<div class="block block-products-carousel" data-layout="{{ $layout }}">
	<div class="container">
		<div class="section-header">
			<div class="section-header__body">
				<h2 class="section-header__title">
					@lang('Featured Products')
				</h2>
				<div class="section-header__spring"></div>
				<ul class="section-header__groups">
					<li class="section-header__groups-item">
						<button type="button" class="section-header__groups-button section-header__groups-button--active">
							@lang('All')
						</button>
					</li>
					<li class="section-header__groups-item">
						<button type="button" class="section-header__groups-button">
							Power Tools
						</button>
					</li>
					<li class="section-header__groups-item">
						<button type="button" class="section-header__groups-button">
							Hand Tools
						</button>
					</li>
					<li class="section-header__groups-item">
						<button type="button" class="section-header__groups-button">
							Plumbing
						</button>
					</li>
				</ul>
				<div class="section-header__arrows">
					<div class="arrow section-header__arrow section-header__arrow--prev arrow--prev">
						<button class="arrow__button" type="button">
							@include('svg.arrow_left')
						</button>
					</div>
					<div class="arrow section-header__arrow section-header__arrow--next arrow--next">
						<button class="arrow__button" type="button">
							@include('svg.arrow_right')
						</button>
					</div>
				</div>
				<div class="section-header__divider"></div>
			</div>
		</div>
		<div class="block-products-carousel__carousel">
			<div class="block-products-carousel__carousel-loader"></div>
			<div class="owl-carousel">
				@foreach ($featured_parts as $part)
					<div class="block-products-carousel__column">
						<div class="block-products-carousel__cell">
							<div class="product-card product-card--layout--grid">
								@include('partials.part_card')
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
