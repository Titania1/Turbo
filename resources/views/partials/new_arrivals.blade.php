@if ($new_parts->isNotEmpty())
<div class="block block-products-carousel" data-layout="horizontal">
	<div class="container">
		<div class="section-header">
			<div class="section-header__body">
				<h2 class="section-header__title">@lang('New Arrivals')</h2>
				<div class="section-header__spring"></div>
				<ul class="section-header__links">
					<li class="section-header__links-item">
						<a href="#" class="section-header__links-link">
							Wheel Covers
						</a>
					</li>
					<li class="section-header__links-item">
						<a href="#" class="section-header__links-link">
							Timing Belts</a>
					</li>
					<li class="section-header__links-item">
						<a href="#" class="section-header__links-link">Oil
							Pans
						</a>
					</li>
					<li class="section-header__links-item">
						<a href="#" class="section-header__links-link">
							@lang('Show All')
						</a>
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
				@foreach ($new_parts->chunk(2) as $chunk)
				<div class="block-products-carousel__column">
					@foreach ($chunk as $part)
					<div class="block-products-carousel__cell">
						<div class="product-card product-card--layout--horizontal">
							@include('partials.part_card')
						</div>
					</div>
					@endforeach
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endif
