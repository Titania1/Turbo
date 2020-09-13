@extends('layouts.app')

@section('title', $part->title)

@section('content')
<div class="block-header block-header--has-breadcrumb">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first">
						<a href="/" class="breadcrumb__item-link">@lang('Home')</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page">
						<span class="breadcrumb__item-link">
							{{ $part->title }}
						</span>
					</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="block-split">
	<div class="container">
		<div class="block-split__row row no-gutters">
			<div class="block-split__item block-split__item-content col-auto">
				<div class="product product--layout--full">
					<div class="product__body">
						<div class="product__card product__card--one"></div>
						<div class="product__card product__card--two"></div>
						<div class="product-gallery product-gallery--layout--product-full product__gallery" data-layout="product-full">
							<div class="product-gallery__featured">
								<button type="button" class="product-gallery__zoom">
									@include('svg.magnifier')
								</button>
								<div class="owl-carousel">
									<a href="/images/products/product-2-700x700.jpg" target="_blank">
										<img src="/images/products/product-2-500x500.jpg" alt="">
									</a>
									<a href="/images/products/product-1-700x700.jpg" target="_blank">
										<img src="/images/products/product-1-500x500.jpg" alt="">
									</a>
									<a href="/images/products/product-3-700x700.jpg" target="_blank">
										<img src="/images/products/product-3-500x500.jpg" alt="">
									</a>
									<a href="/images/products/product-4-700x700.jpg" target="_blank">
										<img src="/images/products/product-4-500x500.jpg" alt="">
									</a>
								</div>
							</div>
							<div class="product-gallery__thumbnails">
								<div class="owl-carousel">
									<a href="/images/products/product-2-700x700.jpg" class="product-gallery__thumbnails-item" target="_blank">
										<img src="/images/products/product-2-70x70.jpg" alt="">
									</a>
									<a href="/images/products/product-1-700x700.jpg" class="product-gallery__thumbnails-item" target="_blank">
										<img src="/images/products/product-1-70x70.jpg" alt="">
									</a>
									<a href="/images/products/product-3-700x700.jpg" class="product-gallery__thumbnails-item" target="_blank">
										<img src="/images/products/product-3-70x70.jpg" alt="">
									</a>
									<a href="/images/products/product-4-700x700.jpg" class="product-gallery__thumbnails-item" target="_blank">
										<img src="/images/products/product-4-70x70.jpg" alt="">
									</a>
								</div>
							</div>
						</div>
						<div class="product__header">
							<h1 class="product__title">{{ $part->title }}</h1>
							<div class="product__subtitle">
								<div class="product__rating">
									<div class="product__rating-stars">
										<div class="rating">
											<div class="rating__body">
												@for($i = 0; $i < $part->rating; $i++)
													<div class="rating__star rating__star--active"></div>
													@endfor
													@for($s = $part->rating; $s < 5; $s++) <div class="rating__star">
											</div>
											@endfor
										</div>
									</div>
								</div>
								<div class="product__rating-label"><a href="#">3.5 on 7 reviews</a></div>
							</div>
							<div class="status-badge status-badge--style--success product__fit status-badge--has-icon status-badge--has-text">
								<div class="status-badge__body">
									<div class="status-badge__icon">
										@include('svg.valid')
									</div>
									<div class="status-badge__text">Part Fit for 2011 Ford Focus S</div>
									<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="Part&#x20;Fit&#x20;for&#x20;2011&#x20;Ford&#x20;Focus&#x20;S"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="product__main">
						<div class="product__excerpt">{{ $part->excerpt }}</div>
						@if($part->key_features)
						<div class="product__features">
							<div class="product__features-title">@lang('Key Features'):</div>
							<ul>
								@foreach ($part->key_features as $feature => $value)
								<li>{{ $feature }}: <span>{{ $value }}</span></li>
								@endforeach
							</ul>
						</div>
						@endif
					</div>
					<div class="product__info">
						<div class="product__info-card">
							<div class="product__info-body">
								@if($part->old_price)
								<div class="product__badge tag-badge tag-badge--sale">@lang('sale')</div>
								@endif
								@if($part->isHot)
								<div class="product__badge tag-badge tag-badge--hot">@lang('hot')</div>
								@endif
								@if($part->wasRecentlyCreated)
								<div class="product__badge tag-badge tag-badge--new">@lang('new')</div>
								@endif
								<div class="product__prices-stock">
									<div class="product__prices">
										<div class="product__price product__price--current">{{ $part->price }} DZD</div>
									</div>
									<div class="status-badge status-badge--style--success product__stock status-badge--has-text">
										<div class="status-badge__body">
											<div class="status-badge__text">In Stock</div>
											<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="In&#x20;Stock"></div>
										</div>
									</div>
								</div>
								<div class="product__meta">
									<table>
										<tr>
											<th>@lang('SKU')</th>
											<td>{{ $part->sku ?? __('unavailable') }}</td>
										</tr>
										@if($part->brand)
										<tr>
											<th>@lang('brand')</th>
											<td>
												<a href="{{ route('brand', ['brand' => $part->brand]) }}">
													{{ $part->brand->name }}
												</a>
											</td>
										</tr>
										<tr>
											<th>@lang('Country')</th>
											<td>{{ __($part->brand->country) }}</td>
										</tr>
										@endif
										@if($part->user->store)
										<tr>
											<th>@lang('Store')</th>
											<td>
												<a href="{{ route('store', ['store' => $part->user->store]) }}">
													{{ $part->user->store->name }}
												</a>
											</td>
										</tr>
										@endif
									</table>
								</div>
							</div>
							<div class="product-form product__form">
								<div class="product-form__body">
									<div class="product-form__row">
										<div class="product-form__title">Material</div>
										<div class="product-form__control">
											<div class="input-radio-label">
												<div class="input-radio-label__list">
													<label class="input-radio-label__item">
														<input type="radio" name="material" class="input-radio-label__input">
														<span class="input-radio-label__title">Steel
														</span>
													</label>
													<label class="input-radio-label__item">
														<input type="radio" name="material" class="input-radio-label__input">
														<span class="input-radio-label__title">Aluminium
														</span>
													</label>
													<label class="input-radio-label__item">
														<input type="radio" name="material" class="input-radio-label__input" disabled="disabled">
														<span class="input-radio-label__title">Thorium
														</span>
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="product-form__row">
										<div class="product-form__title">Color</div>
										<div class="product-form__control">
											<div class="input-radio-color">
												<div class="input-radio-color__list">
													<label class="input-radio-color__item input-radio-color__item--white" style="color: #fff;" data-toggle="tooltip" title="White">
														<input type="radio" name="color">
														<span>
														</span>
													</label>
													<label class="input-radio-color__item" style="color: #ffd333;" data-toggle="tooltip" title="Yellow"><input type="radio" name="color">
														<span>
														</span>
													</label>
													<label class="input-radio-color__item" style="color: #ff4040;" data-toggle="tooltip" title="Red">
														<input type="radio" name="color">
														<span>
														</span>
													</label>
													<label class="input-radio-color__item input-radio-color__item--disabled" style="color: #4080ff;" data-toggle="tooltip" title="Blue">
														<input type="radio" name="color" disabled="disabled">
														<span>
														</span>
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="product__actions">

								<part-quantity-update :part='@json($part)' />

								<div class="product__actions-divider"></div>
								<button class="product__actions-item product__actions-item--wishlist" type="button">
									@include('svg.heart')
									<span>Add to wishlist</span>
								</button>
								<div class="product__actions-divider"></div>
								<button class="product__actions-item product__actions-item--compare" type="button">
									@include('svg.chart')
									<span>Add to compare </span>
								</button>
							</div>
							<div class="product__tags-and-share-links">
								<div class="product__tags tags tags--sm">
									<div class="tags__list"><a href="#">Brake Kit</a> <a href="#">Brandix</a> <a href="#">Filter</a> <a href="#">Bumper</a> <a href="#">Transmission</a> <a href="#">Hood</a></div>
								</div>
								<div class="product__share-links share-links">
									<ul class="share-links__list">
										<li class="share-links__item share-links__item--type--like"><a href="#">Like</a></li>
										<li class="share-links__item share-links__item--type--tweet"><a href="#">Tweet</a></li>
										<li class="share-links__item share-links__item--type--pin"><a href="#">Pin It</a></li>
										<li class="share-links__item share-links__item--type--counter"><a href="#">4K</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="product__shop-features shop-features">
							<ul class="shop-features__list">
								<li class="shop-features__item">
									<div class="shop-features__item-icon">
										@include('svg.free_shipping')
									</div>
									<div class="shop-features__info">
										<div class="shop-features__item-title">@lang('Free Shipping')</div>
										<div class="shop-features__item-subtitle">@lang('For orders from 50000 DA')</div>
									</div>
								</li>
								<li class="shop-features__divider" role="presentation"></li>
								<li class="shop-features__item">
									<div class="shop-features__item-icon">
										@include('svg.mobile_24x7')
									</div>
									<div class="shop-features__info">
										<div class="shop-features__item-title">@lang('Support 24/7')</div>
										<div class="shop-features__item-subtitle">@lang('Call us anytime')</div>
									</div>
								</li>
								<li class="shop-features__divider" role="presentation"></li>
								<li class="shop-features__item">
									<div class="shop-features__item-icon">
										@include('svg.secure_payments')
									</div>
									<div class="shop-features__info">
										<div class="shop-features__item-title">@lang('100% Safety')</div>
										<div class="shop-features__item-subtitle">@lang('Only secure payments')</div>
									</div>
								</li>
								<li class="shop-features__divider" role="presentation"></li>
								<li class="shop-features__item">
									<div class="shop-features__item-icon">
										@include('svg.hot_offers')
									</div>
									<div class="shop-features__info">
										<div class="shop-features__item-title">@lang('Hot Offers')</div>
										<div class="shop-features__item-subtitle">@lang('Discounts up to 50%')</div>
									</div>
								</li>
								<li class="shop-features__divider" role="presentation"></li>
							</ul>
						</div>
					</div>
					<div class="product__tabs product-tabs product-tabs--layout--full">
						<ul class="product-tabs__list">
							<li class="product-tabs__item @if(!session('active_tab')) product-tabs__item--active @endif">
								<a href="#product-tab-description">
									@lang('Description')
								</a>
							</li>
							<li class="product-tabs__item">
								<a href="#product-tab-specification">
									Specification
								</a>
							</li>
							<li class="product-tabs__item @if(session('active_tab')) product-tabs__item--active @endif">
								<a href="#product-tab-reviews">
									@lang('Reviews')
									<span class="product-tabs__item-counter">
										{{ $part->reviews()->count() }}
									</span>
								</a>
							</li>
							<li class="product-tabs__item">
								<a href="#product-tab-analogs">
									Analogs
								</a>
							</li>
						</ul>
						<div class="product-tabs__content">
							<div class="product-tabs__pane @if(!session('active_tab')) product-tabs__pane--active @endif" id="product-tab-description">
								<div class="typography">
									<p>
										{!! $part->description !!}
									</p>
								</div>
							</div>
							<div class="product-tabs__pane" id="product-tab-specification">
								<div class="spec">
									<div class="spec__section">
										<h4 class="spec__section-title">General</h4>
										<div class="spec__row">
											<div class="spec__name">Material</div>
											<div class="spec__value">Aluminium, Plastic</div>
										</div>
										<div class="spec__row">
											<div class="spec__name">Engine Type</div>
											<div class="spec__value">Brushless</div>
										</div>
										<div class="spec__row">
											<div class="spec__name">Battery Voltage</div>
											<div class="spec__value">18 V</div>
										</div>
										<div class="spec__row">
											<div class="spec__name">Battery Type</div>
											<div class="spec__value">Li-lon</div>
										</div>
										<div class="spec__row">
											<div class="spec__name">Number of Speeds</div>
											<div class="spec__value">2</div>
										</div>
										<div class="spec__row">
											<div class="spec__name">Charge Time</div>
											<div class="spec__value">1.08 h</div>
										</div>
										<div class="spec__row">
											<div class="spec__name">Weight</div>
											<div class="spec__value">1.5 kg</div>
										</div>
									</div>
									<div class="spec__section">
										<h4 class="spec__section-title">Dimensions</h4>
										<div class="spec__row">
											<div class="spec__name">Length</div>
											<div class="spec__value">99 mm</div>
										</div>
										<div class="spec__row">
											<div class="spec__name">Width</div>
											<div class="spec__value">207 mm</div>
										</div>
										<div class="spec__row">
											<div class="spec__name">Height</div>
											<div class="spec__value">208 mm</div>
										</div>
									</div>
									<div class="spec__disclaimer">Information on technical characteristics, the delivery set, the country
										of manufacture and the appearance of the goods is for reference only and is based on the latest
										information available at the time of publication.</div>
								</div>
							</div>
							@include('partials.part.reviews')
							<div class="product-tabs__pane" id="product-tab-analogs">
								<table class="analogs-table">
									<thead>
										<tr>
											<th class="analogs-table__column analogs-table__column--name">Name</th>
											<th class="analogs-table__column analogs-table__column--rating">Rating</th>
											<th class="analogs-table__column analogs-table__column--vendor">Vendor</th>
											<th class="analogs-table__column analogs-table__column--price">Price</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="analogs-table__column analogs-table__column--name"><a href="#" class="analogs-table__product-name">Sunset Brake Kit</a><br>
												<div class="analogs-table__sku" data-title="SKU">SSX-780B390-S</div>
											</td>
											<td class="analogs-table__column analogs-table__column--rating">
												<div class="analogs-table__rating">
													<div class="analogs-table__rating-stars">
														<div class="rating">
															<div class="rating__body">
																<div class="rating__star rating__star--active"></div>
																<div class="rating__star rating__star--active"></div>
																<div class="rating__star rating__star--active"></div>
																<div class="rating__star rating__star--active"></div>
																<div class="rating__star"></div>
															</div>
														</div>
													</div>
													<div class="analogs-table__rating-label">10 Reviews</div>
												</div>
											</td>
											<td class="analogs-table__column analogs-table__column--vendor" data-title="Vendor">Sunset<div class="analogs-table__country">(Germany)</div>
											</td>
											<td class="analogs-table__column analogs-table__column--price">$1259.00</td>
										</tr>
										<tr>
											<td class="analogs-table__column analogs-table__column--name"><a href="#" class="analogs-table__product-name">Specter Brake Kit</a><br>
												<div class="analogs-table__sku" data-title="SKU">SCT-123A380-S</div>
											</td>
											<td class="analogs-table__column analogs-table__column--rating">
												<div class="analogs-table__rating">
													<div class="analogs-table__rating-stars">
														<div class="rating">
															<div class="rating__body">
																<div class="rating__star rating__star--active"></div>
																<div class="rating__star rating__star--active"></div>
																<div class="rating__star rating__star--active"></div>
																<div class="rating__star rating__star--active"></div>
																<div class="rating__star rating__star--active"></div>
															</div>
														</div>
													</div>
													<div class="analogs-table__rating-label">34 Reviews</div>
												</div>
											</td>
											<td class="analogs-table__column analogs-table__column--vendor" data-title="Vendor">Specter<div class="analogs-table__country">(China)</div>
											</td>
											<td class="analogs-table__column analogs-table__column--price">$799.00</td>
										</tr>
										<tr>
											<td class="analogs-table__column analogs-table__column--name"><a href="#" class="analogs-table__product-name">Brake Kit</a><br>
												<div class="analogs-table__sku" data-title="SKU">NNO-120K643-S</div>
											</td>
											<td class="analogs-table__column analogs-table__column--rating">
												<div class="analogs-table__rating">
													<div class="analogs-table__rating-stars">
														<div class="rating">
															<div class="rating__body">
																<div class="rating__star rating__star--active"></div>
																<div class="rating__star rating__star--active"></div>
																<div class="rating__star rating__star--active"></div>
																<div class="rating__star"></div>
																<div class="rating__star"></div>
															</div>
														</div>
													</div>
													<div class="analogs-table__rating-label">7 Reviews</div>
												</div>
											</td>
											<td class="analogs-table__column analogs-table__column--vendor" data-title="Vendor">No Name<div class="analogs-table__country">(China)</div>
											</td>
											<td class="analogs-table__column analogs-table__column--price">$569.00</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="block-space block-space--layout--divider-nl"></div>
			<div class="block block-products-carousel" data-layout="grid-5">
				<div class="container">
					<div class="section-header">
						<div class="section-header__body">
							<h2 class="section-header__title">Related Products</h2>
							<div class="section-header__spring"></div>
							<div class="section-header__arrows">
								<div class="arrow section-header__arrow section-header__arrow--prev arrow--prev"><button class="arrow__button" type="button">
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
							<div class="block-products-carousel__column">
								<div class="block-products-carousel__cell">
									<div class="product-card product-card--layout--grid">
										<div class="product-card__actions-list">
											<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">
												@include('svg.zoom')
											</button>
											<button class="product-card__action product-card__action--wishlist" type="button" aria-label="Add to wish list">
												@include('svg.heart')
											</button>
											<button class="product-card__action product-card__action--compare" type="button" aria-label="Add to compare">
												@include('svg.chart')
											</button>
										</div>
										<div class="product-card__image"><a href="product-full.html">
												<img src="/images/products/product-1-245x245.jpg" alt=""></a>
											<div class="status-badge status-badge--style--success product-card__fit status-badge--has-icon status-badge--has-text">
												<div class="status-badge__body">
													<div class="status-badge__icon">
														@include('svg.valid')
													</div>
													<div class="status-badge__text">Part Fit for 2011 Ford Focus S</div>
													<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="Part&#x20;Fit&#x20;for&#x20;2011&#x20;Ford&#x20;Focus&#x20;S"></div>
												</div>
											</div>
										</div>
										<div class="product-card__info">
											<div class="product-card__meta">
												<span class="product-card__meta-title">SKU:
												</span> 140-10440-B
											</div>
											<div class="product-card__name">
												<div>
													<div class="product-card__badges">
														<div class="tag-badge tag-badge--sale">@lang('sale')</div>
														<div class="tag-badge tag-badge--new">@lang('new')</div>
														<div class="tag-badge tag-badge--hot">@lang('hot')</div>
													</div>
													<a href="{{ route('part', ['part' => $part]) }}">
														{{ $part->title }}
													</a>
												</div>
											</div>
											<div class="product-card__rating">
												<div class="rating product-card__rating-stars">
													<div class="rating__body">
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star"></div>
													</div>
												</div>
												<div class="product-card__rating-label">4 on 3 reviews</div>
											</div>
										</div>
										<div class="product-card__footer">
											<div class="product-card__prices">
												<div class="product-card__price product-card__price--current">$19.00</div>
											</div>
											<button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
												@include('svg.shop_circle')
											</button>
										</div>
									</div>
								</div>
							</div>
							<div class="block-products-carousel__column">
								<div class="block-products-carousel__cell">
									<div class="product-card product-card--layout--grid">
										<div class="product-card__actions-list">
											<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">@include('svg.zoom')
											</button>
											<button class="product-card__action product-card__action--wishlist" type="button" aria-label="Add to wish list">@include('svg.heart')
											</button>
											<button class="product-card__action product-card__action--compare" type="button" aria-label="Add to compare">@include('svg.chart')
											</button>
										</div>
										<div class="product-card__image"><a href="product-full.html">
												<img src="/images/products/product-2-245x245.jpg" alt=""></a>
											<div class="status-badge status-badge--style--success product-card__fit status-badge--has-icon status-badge--has-text">
												<div class="status-badge__body">
													<div class="status-badge__icon">@include('svg.valid')</div>
													<div class="status-badge__text">Part Fit for 2011 Ford Focus S</div>
													<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="Part&#x20;Fit&#x20;for&#x20;2011&#x20;Ford&#x20;Focus&#x20;S"></div>
												</div>
											</div>
											<form action="{{ route('cart.add', ['part' => $part]) }}" method="post">

										</div>
										<div class="product-card__info">
											<div class="product-card__meta">
												<span class="product-card__meta-title">SKU:
												</span> 573-23743-C
											</div>
											<div class="product-card__name">
												<div>
													<a href="product-full.html">Brandix Brake Kit BDX-750Z370-S
													</a>
												</div>
											</div>
											<div class="product-card__rating">
												<div class="rating product-card__rating-stars">
													<div class="rating__body">
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
													</div>
												</div>
												<div class="product-card__rating-label">5 on 22 reviews</div>
											</div>
										</div>
										<div class="product-card__footer">
											<div class="product-card__prices">
												<div class="product-card__price product-card__price--current">$224.00</div>
											</div>
											<button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">@include('svg.shop_circle')
											</button>
										</div>
									</div>
								</div>
							</div>
							<div class="block-products-carousel__column">
								<div class="block-products-carousel__cell">
									<div class="product-card product-card--layout--grid">
										<div class="product-card__actions-list">
											<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">@include('svg.zoom')
											</button>
											<button class="product-card__action product-card__action--wishlist" type="button" aria-label="Add to wish list">@include('svg.heart')
											</button>
											<button class="product-card__action product-card__action--compare" type="button" aria-label="Add to compare">@include('svg.chart')
											</button>
										</div>
										<div class="product-card__image"><a href="product-full.html">
												<img src="/images/products/product-3-245x245.jpg" alt=""></a>
											<div class="status-badge status-badge--style--success product-card__fit status-badge--has-icon status-badge--has-text">
												<div class="status-badge__body">
													<div class="status-badge__icon">@include('svg.valid')
													</div>
													<div class="status-badge__text">Part Fit for 2011 Ford Focus S
													</div>
													<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="Part&#x20;Fit&#x20;for&#x20;2011&#x20;Ford&#x20;Focus&#x20;S">
													</div>
												</div>
											</div>
										</div>
										<div class="product-card__info">
											<div class="product-card__meta">
												<span class="product-card__meta-title">SKU:
												</span> 009-50078-Z
											</div>
											<div class="product-card__name">
												<div>
													<div class="product-card__badges">
														<div class="tag-badge tag-badge--sale">@lang('sale')</div>
													</div><a href="product-full.html">Left Headlight Of Brandix Z54</a>
												</div>
											</div>
											<div class="product-card__rating">
												<div class="rating product-card__rating-stars">
													<div class="rating__body">
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star"></div>
														<div class="rating__star"></div>
													</div>
												</div>
												<div class="product-card__rating-label">3 on 14 reviews</div>
											</div>
										</div>
										<div class="product-card__footer">
											<div class="product-card__prices">
												<div class="product-card__price product-card__price--new">$349.00</div>
												<div class="product-card__price product-card__price--old">$415.00</div>
											</div>
											<button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">@include('svg.shop_circle')
											</button>
										</div>
									</div>
								</div>
							</div>
							<div class="block-products-carousel__column">
								<div class="block-products-carousel__cell">
									<div class="product-card product-card--layout--grid">
										<div class="product-card__actions-list">
											<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">@include('svg.zoom')
											</button>
											<button class="product-card__action product-card__action--wishlist" type="button" aria-label="Add to wish list">@include('svg.heart')
											</button>
											<button class="product-card__action product-card__action--compare" type="button" aria-label="Add to compare">
												@include('svg.chart')
											</button>
										</div>
										<div class="product-card__image"><a href="product-full.html">
												<img src="/images/products/product-4-245x245.jpg" alt="">
											</a>
											<div class="status-badge status-badge--style--success product-card__fit status-badge--has-icon status-badge--has-text">
												<div class="status-badge__body">
													<div class="status-badge__icon">
														@include('svg.valid')
													</div>
													<div class="status-badge__text">Part Fit for 2011 Ford Focus S</div>
													<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="Part&#x20;Fit&#x20;for&#x20;2011&#x20;Ford&#x20;Focus&#x20;S"></div>
												</div>
											</div>
										</div>
										<div class="product-card__info">
											<div class="product-card__meta">
												<span class="product-card__meta-title">SKU:
												</span> A43-44328-Bitem
											</div>
											<div class="product-card__name">
												<div>
													<div class="product-card__badges">
														<div class="tag-badge tag-badge--hot">@lang('hot')</div>
													</div><a href="product-full.html">Glossy Gray 19" Aluminium Wheel AR-19</a>
												</div>
											</div>
											<div class="product-card__rating">
												<div class="rating product-card__rating-stars">
													<div class="rating__body">
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star"></div>
													</div>
												</div>
												<div class="product-card__rating-label">4 on 26 reviews</div>
											</div>
										</div>
										<div class="product-card__footer">
											<div class="product-card__prices">
												<div class="product-card__price product-card__price--current">$589.00</div>
											</div>
											<button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
												@include('svg.shop_circle')
											</button>
										</div>
									</div>
								</div>
							</div>
							<div class="block-products-carousel__column">
								<div class="block-products-carousel__cell">
									<div class="product-card product-card--layout--grid">
										<div class="product-card__actions-list">
											<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">@include('svg.zoom')
											</button>
											<button class="product-card__action product-card__action--wishlist" type="button" aria-label="Add to wish list">@include('svg.heart')
											</button>
											<button class="product-card__action product-card__action--compare" type="button" aria-label="Add to compare">@include('svg.chart')
											</button>
										</div>
										<div class="product-card__image">
											<a href="product-full.html">
												<img src="/images/products/product-5-245x245.jpg" alt=""></a>
											<div class="status-badge status-badge--style--success product-card__fit status-badge--has-icon status-badge--has-text">
												<div class="status-badge__body">
													<div class="status-badge__icon">
														@include('svg.valid')
													</div>
													<div class="status-badge__text">Part Fit for 2011 Ford Focus S
													</div>
													<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="Part&#x20;Fit&#x20;for&#x20;2011&#x20;Ford&#x20;Focus&#x20;S"></div>
												</div>
											</div>
										</div>
										<div class="product-card__info">
											<div class="product-card__meta">
												<span class="product-card__meta-title">SKU:
												</span> 729-51203-B
											</div>
											<div class="product-card__name">
												<div><a href="product-full.html">Twin Exhaust Pipe From Brandix Z54
													</a>
												</div>
											</div>
											<div class="product-card__rating">
												<div class="rating product-card__rating-stars">
													<div class="rating__body">
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star"></div>
													</div>
												</div>
												<div class="product-card__rating-label">4 on 9 reviews</div>
											</div>
										</div>
										<div class="product-card__footer">
											<div class="product-card__prices">
												<div class="product-card__price product-card__price--current">$749.00</div>
											</div><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
												@include('svg.shop_circle')
											</button>
										</div>
									</div>
								</div>
							</div>
							<div class="block-products-carousel__column">
								<div class="block-products-carousel__cell">
									<div class="product-card product-card--layout--grid">
										<div class="product-card__actions-list">
											<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">@include('svg.zoom')
											</button>
											<button class="product-card__action product-card__action--wishlist" type="button" aria-label="Add to wish list">@include('svg.heart')
											</button>
											<button class="product-card__action product-card__action--compare" type="button" aria-label="Add to compare">
												@include('svg.chart')
											</button>
										</div>
										<div class="product-card__image">
											<a href="product-full.html">
												<img src="/images/products/product-6-245x245.jpg" alt="">
											</a>
											<div class="status-badge status-badge--style--success product-card__fit status-badge--has-icon status-badge--has-text">
												<div class="status-badge__body">
													<div class="status-badge__icon">
														@include('svg.valid')
													</div>
													<div class="status-badge__text">Part Fit for 2011 Ford Focus S</div>
													<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="Part&#x20;Fit&#x20;for&#x20;2011&#x20;Ford&#x20;Focus&#x20;S"></div>
												</div>
											</div>
										</div>
										<div class="product-card__info">
											<div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 573-49386-C
											</div>
											<div class="product-card__name">
												<div><a href="product-full.html">Motor Oil Level 5</a></div>
											</div>
											<div class="product-card__rating">
												<div class="rating product-card__rating-stars">
													<div class="rating__body">
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
													</div>
												</div>
												<div class="product-card__rating-label">5 on 2 reviews</div>
											</div>
										</div>
										<div class="product-card__footer">
											<div class="product-card__prices">
												<div class="product-card__price product-card__price--current">$23.00</div>
											</div>
											<button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">@include('svg.shop_circle')
											</button>
										</div>
									</div>
								</div>
							</div>
							<div class="block-products-carousel__column">
								<div class="block-products-carousel__cell">
									<div class="product-card product-card--layout--grid">
										<div class="product-card__actions-list">
											<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">
												@include('svg.zoom')
											</button>
											<button class="product-card__action product-card__action--wishlist" type="button" aria-label="Add to wish list">
												@include('svg.heart')
											</button>
											<button class="product-card__action product-card__action--compare" type="button" aria-label="Add to compare">@include('svg.chart')
											</button>
										</div>
										<div class="product-card__image">
											<a href="product-full.html">
												<img src="/images/products/product-7-245x245.jpg" alt="">
											</a>
											<div class="status-badge status-badge--style--success product-card__fit status-badge--has-icon status-badge--has-text">
												<div class="status-badge__body">
													<div class="status-badge__icon">
														@include('svg.valid')
													</div>
													<div class="status-badge__text">Part Fit for 2011 Ford Focus S</div>
													<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="Part&#x20;Fit&#x20;for&#x20;2011&#x20;Ford&#x20;Focus&#x20;S"></div>
												</div>
											</div>
										</div>
										<div class="product-card__info">
											<div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 753-38573-B
											</div>
											<div class="product-card__name">
												<div><a href="product-full.html">Brandix Engine Block Z4</a></div>
											</div>
											<div class="product-card__rating">
												<div class="rating product-card__rating-stars">
													<div class="rating__body">
														<div class="rating__star"></div>
														<div class="rating__star"></div>
														<div class="rating__star"></div>
														<div class="rating__star"></div>
														<div class="rating__star"></div>
													</div>
												</div>
												<div class="product-card__rating-label">0 on 0 reviews</div>
											</div>
										</div>
										<div class="product-card__footer">
											<div class="product-card__prices">
												<div class="product-card__price product-card__price--current">$452.00</div>
											</div><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
												@include('svg.shop_circle')
											</button>
										</div>
									</div>
								</div>
							</div>
							<div class="block-products-carousel__column">
								<div class="block-products-carousel__cell">
									<div class="product-card product-card--layout--grid">
										<div class="product-card__actions-list">
											<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">
												@include('svg.zoom')
											</button>
											<button class="product-card__action product-card__action--wishlist" type="button" aria-label="Add to wish list">@include('svg.heart')
											</button>
											<button class="product-card__action product-card__action--compare" type="button" aria-label="Add to compare">
												@include('svg.chart')
											</button>
										</div>
										<div class="product-card__image">
											<a href="product-full.html">
												<img src="/images/products/product-8-245x245.jpg" alt="">
											</a>
											<div class="status-badge status-badge--style--success product-card__fit status-badge--has-icon status-badge--has-text">
												<div class="status-badge__body">
													<div class="status-badge__icon">
														@include('svg.valid')
													</div>
													<div class="status-badge__text">Part Fit for 2011 Ford Focus S</div>
													<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="Part&#x20;Fit&#x20;for&#x20;2011&#x20;Ford&#x20;Focus&#x20;S"></div>
												</div>
											</div>
										</div>
										<div class="product-card__info">
											<div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 472-67382-Z
											</div>
											<div class="product-card__name">
												<div><a href="product-full.html">Brandix Clutch Discs Z175</a></div>
											</div>
											<div class="product-card__rating">
												<div class="rating product-card__rating-stars">
													<div class="rating__body">
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star"></div>
														<div class="rating__star"></div>
													</div>
												</div>
												<div class="product-card__rating-label">3 on 7 reviews</div>
											</div>
										</div>
										<div class="product-card__footer">
											<div class="product-card__prices">
												<div class="product-card__price product-card__price--current">$345.00</div>
											</div>
											<button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
												@include('svg.shop_circle')
											</button>
										</div>
									</div>
								</div>
							</div>
							<div class="block-products-carousel__column">
								<div class="block-products-carousel__cell">
									<div class="product-card product-card--layout--grid">
										<div class="product-card__actions-list">
											<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">@include('svg.zoom')
											</button>
											<button class="product-card__action product-card__action--wishlist" type="button" aria-label="Add to wish list">
												@include('svg.heart')
											</button>
											<button class="product-card__action product-card__action--compare" type="button" aria-label="Add to compare">
												@include('svg.chart')
											</button>
										</div>
										<div class="product-card__image">
											<a href="product-full.html">
												<img src="/images/products/product-9-245x245.jpg" alt="">
											</a>
											<div class="status-badge status-badge--style--success product-card__fit status-badge--has-icon status-badge--has-text">
												<div class="status-badge__body">
													<div class="status-badge__icon">
														@include('svg.valid')
													</div>
													<div class="status-badge__text">Part Fit for 2011 Ford Focus S</div>
													<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="Part&#x20;Fit&#x20;for&#x20;2011&#x20;Ford&#x20;Focus&#x20;S"></div>
												</div>
											</div>
										</div>
										<div class="product-card__info">
											<div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 855-78336-G
											</div>
											<div class="product-card__name">
												<div><a href="product-full.html">Brandix Manual Five Speed Gearbox</a></div>
											</div>
											<div class="product-card__rating">
												<div class="rating product-card__rating-stars">
													<div class="rating__body">
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star"></div>
													</div>
												</div>
												<div class="product-card__rating-label">4 on 6 reviews</div>
											</div>
										</div>
										<div class="product-card__footer">
											<div class="product-card__prices">
												<div class="product-card__price product-card__price--current">$879.00</div>
											</div>
											<button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">@include('svg.shop_circle')
											</button>
										</div>
									</div>
								</div>
							</div>
							<div class="block-products-carousel__column">
								<div class="block-products-carousel__cell">
									<div class="product-card product-card--layout--grid">
										<div class="product-card__actions-list">
											<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">
												@include('svg.zoom')
											</button>
											<button class="product-card__action product-card__action--wishlist" type="button" aria-label="Add to wish list">
												@include('svg.heart')
											</button>
											<button class="product-card__action product-card__action--compare" type="button" aria-label="Add to compare">
												@include('svg.chart')
											</button>
										</div>
										<div class="product-card__image">
											<a href="product-full.html">
												<img src="/images/products/product-10-245x245.jpg" alt="">
											</a>
											<div class="status-badge status-badge--style--success product-card__fit status-badge--has-icon status-badge--has-text">
												<div class="status-badge__body">
													<div class="status-badge__icon">
														@include('svg.valid')
													</div>
													<div class="status-badge__text">Part Fit for 2011 Ford Focus S</div>
													<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="Part&#x20;Fit&#x20;for&#x20;2011&#x20;Ford&#x20;Focus&#x20;S"></div>
												</div>
											</div>
										</div>
										<div class="product-card__info">
											<div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 473-75662-R
											</div>
											<div class="product-card__name">
												<div><a href="product-full.html">Set of Car Floor Mats Brandix Z4</a></div>
											</div>
											<div class="product-card__rating">
												<div class="rating product-card__rating-stars">
													<div class="rating__body">
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star rating__star--active"></div>
														<div class="rating__star"></div>
													</div>
												</div>
												<div class="product-card__rating-label">4 on 16 reviews</div>
											</div>
										</div>
										<div class="product-card__footer">
											<div class="product-card__prices">
												<div class="product-card__price product-card__price--current">$78.00</div>
											</div>
											<button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
												@include('svg.shop_circle')
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
@stop



<script>
	(function() {
		const classname = document.querySelectorAll('.quantity')
		Array.from(classname).forEach(function(element) {
			element.addEventListener('change', function() {
				const id = element.getAttribute('data-id')
				const partQuantity = element.getAttribute('data-partQuantity')
				axios.patch(`/cart/${id}`, {
					quantity: this.value,
					partQuantity: partQuantity
				})

			})
		})
	})();
</script>
