@extends('layouts.app')

@section('title', __('Wishlist'))

@section('content')
<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first">
						<a href="/" class="breadcrumb__item-link">
							@lang('Home')
						</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--parent">
						<a href="{{ route('wishlist') }}" class="breadcrumb__item-link">
							@lang('Wishlist')
						</a>
					</li>
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
			<h1 class="block-header__title">@lang('Wishlist')</h1>
		</div>
	</div>
</div>
<div class="block">
	<div class="container container--max--xl">
		@if(session()->has('wishlist'))
		<table class=" wishlist__table">
			<thead class="wishlist__head">
				<tr class="wishlist__row wishlist__row--head">
					<th class="wishlist__column wishlist__column--head wishlist__column--image">
						@lang('Image')
					</th>
					<th class="wishlist__column wishlist__column--head wishlist__column--product">
						@lang('Product')
					</th>
					<th class="wishlist__column wishlist__column--head wishlist__column--stock">
						@lang('Stock status')
					</th>
					<th class="wishlist__column wishlist__column--head wishlist__column--price">
						@lang('Price')
					</th>
					<th class="wishlist__column wishlist__column--head wishlist__column--button"></th>
					<th class="wishlist__column wishlist__column--head wishlist__column--remove">
						@lang('Remove')
					</th>
				</tr>
			</thead>
			<tbody class="wishlist__body">
				@foreach($wishlist as $item)
					<tr class="wishlist__row wishlist__row--body">
						<td class="wishlist__column wishlist__column--body wishlist__column--image">
							<a href="{{ route('part', ['part' => $item->model]) }}">
								<img src="{{ secure_asset($item->model->image) }}" alt="@lang('Photo')">
							</a>
						</td>
						<td class="wishlist__column wishlist__column--body wishlist__column--product">
							<div class="wishlist__product-name">
								<a href="{{ route('part', ['part' => $item->model]) }}">
									{{ $item->title }}
								</a>
							</div>
							<div class="wishlist__product-rating">
								<div class="wishlist__product-rating-stars">
									@include('partials.rating', ['item' => $item])
								</div>
							</div>
							<div class="wishlist__product-rating-title">
								{{ $item->reviews()->count() }}
							</div>
						</td>
						<td class="wishlist__column wishlist__column--body wishlist__column--stock">
							<div class="status-badge status-badge--style--success status-badge--has-text">
								<div class="status-badge__body">
									@if($part->inStock)
										<div class="status-badge__text">@lang('In Stock')</div>
									@else
										<div class="status-badge__text">@lang('Out Stock')</div>
									@endif
								</div>
							</div>
						</td>z
						<td class="wishlist__column wishlist__column--body wishlist__column--price">
							{{ $item->price }}
						</td>
						<td class="wishlist__column wishlist__column--body wishlist__column--button">
							<button type="button" class="btn btn-sm btn-primary">@lang('Add to cart')</button>
						</td>
						<td class="wishlist__column wishlist__column--body wishlist__column--remove">
							<button type="button" class="wishlist__remove btn btn-sm btn-muted btn-icon">
								@include('svg.X')
							</button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

@endif
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
@stop
