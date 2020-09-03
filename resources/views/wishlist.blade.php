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


		<div class="block">
			<div class="container container--max--xl">
				<table class=" wishlist__table">
					<thead class="wishlist__head">
						<tr class="wishlist__row wishlist__row--head">
							<th class="wishlist__column wishlist__column--head wishlist__column--image">Image</th>
							<th class="wishlist__column wishlist__column--head wishlist__column--product">Product</th>
							<th class="wishlist__column wishlist__column--head wishlist__column--stock">Stock status</th>
							<th class="wishlist__column wishlist__column--head wishlist__column--price">Price</th>
							<th class="wishlist__column wishlist__column--head wishlist__column--button"></th>
							<th class="wishlist__column wishlist__column--head wishlist__column--remove"></th>
						</tr>
					</thead>


					<tbody class="wishlist__body">
						@@if(session()->has('wishlist'))
						Session::get('wishlist')
						@foreach ("$wishlist" as $item)
						<tr class="wishlist__row wishlist__row--body">
							<td class="wishlist__column wishlist__column--body wishlist__column--image">
								<a href="{{ route('part', ['part' => $item->model]) }}">
									<img src="{{ secure_asset($item->model->image) }}" alt="@lang('Photo')"></a></td>
							<td class="wishlist__column wishlist__column--body wishlist__column--product">
								<div class="wishlist__product-name">
									<a href="{{ route('part', ['part' => $item->model]) }}"> {{ $item->title }} </a></div>
								<div class="wishlist__product-rating">
									<div class="wishlist__product-rating-stars">
										<div class="rating">

											<div class="rating__body">
												@for($i = 0; $i < $item->rating; $i++)
													<div class="rating__star rating__star--active"></div>
													@endfor
													@for($s = $item->rating; $s < 5; $s++) <div class="rating__star">
											</div>
											@endfor
										</div>
									</div>
								</div>
								<div class="wishlist__product-rating-title"> {{ $item->reviews()->count() }}</div>

							</td>
							<td class="wishlist__column wishlist__column--body wishlist__column--stock">
								<div class="status-badge status-badge--style--success status-badge--has-text">
									<div class="status-badge__body">
										@if($part->inStock)
										<div class="status-badge__text">In Stock</div>
										@else
										<div class="status-badge__text">Out Stock</div>
										@endif
									</div>
								</div>
							</td>
							<td class="wishlist__column wishlist__column--body wishlist__column--price"> {{ $item->price }} </td>

							<td class="wishlist__column wishlist__column--body wishlist__column--button">
								<button type="button" class="btn btn-sm btn-primary">Add to cart
								</button>

							</td>
							<td class="wishlist__column wishlist__column--body wishlist__column--remove"><button type="button" class="wishlist__remove btn btn-sm btn-muted btn-icon"><svg width="12" height="12">
										<path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6 c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4 C11.2,9.8,11.2,10.4,10.8,10.8z" />
									</svg></button></td>

						</tr>

						@endforeach


					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
@stop
