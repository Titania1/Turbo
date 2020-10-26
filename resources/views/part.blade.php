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
						<div class="product-gallery product-gallery--layout--product-full product__gallery"
							data-layout="product-full">
							<div class="product-gallery__featured">
								<button type="button" class="product-gallery__zoom">
									@include('svg.magnifier')
								</button>
								<div class="owl-carousel">
									<a href="{{ secure_asset('storage/' . $part->image) }}" target="_blank">
										<img src="{{ secure_asset('storage/' . $part->image) }}" alt="">
									</a>
								</div>
							</div>
							<div class="product-gallery__thumbnails">
								<div class="owl-carousel">
									<a href="{{ secure_asset('storage/' . $part->image) }}" class="product-gallery__thumbnails-item"
										target="_blank">
										<img src="{{ secure_asset('storage/' . $part->image) }}" alt="">
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
										</div>
									</div>
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
								@foreach ($part->features as $feature => $value)
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
											<div class="status-badge__text">@lang('In Stock')</div>
											<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="@lang('In Stock')"></div>
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
							<div class="product__actions">
								<part-quantity-update :part='@json($part)' />
								<div class="product__actions-divider"></div>
								<button class="product__actions-item product__actions-item--wishlist" type="button">
									@include('svg.heart')
									<span>
										@lang('Add to wishlist')
									</span>
								</button>
								<button class="product__actions-item product__actions-item--compare" type="button">
									@include('svg.chart')
									<span>
										@lang('Add to compare')
									</span>
								</button>
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
							<li class="product-tabs__item @if(session('active_tab')) product-tabs__item--active @endif">
								<a href="#product-tab-reviews">
									@lang('Reviews')
									<span class="product-tabs__item-counter">
										{{ $part->reviews()->count() }}
									</span>
								</a>
							</li>
						</ul>
						<div class="product-tabs__content">
							<div class="product-tabs__pane @if(!session('active_tab')) product-tabs__pane--active @endif"
								id="product-tab-description">
								<div class="typography">
									<p>
										{!! $part->description !!}
									</p>
								</div>
							</div>
							@include('partials.part.reviews')
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
