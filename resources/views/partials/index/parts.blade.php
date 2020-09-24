<div class="block block-products-columns">
	<div class="container">
		<div class="row">
			<div class="col-4">
				<div class="block-products-columns__title">
					@lang('Top Rated Products')
				</div>
				<div class="block-products-columns__list">
					<div class="block-products-columns__list-item">
						<div class="product-card">
							@include('partials.part_card')
						</div>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="block-products-columns__title">@lang('Special Offers')</div>
				<div class="block-products-columns__list">
					<div class="block-products-columns__list-item">
						<div class="product-card">
							@include('partials.part_card')
						</div>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="block-products-columns__title">@lang('Bestsellers')</div>
				<div class="block-products-columns__list">
					<div class="block-products-columns__list-item">
						<div class="product-card">
							@include('partials.part_card')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
