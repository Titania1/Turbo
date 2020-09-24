@extends('layouts.app')

@section('title', __('Shopping Cart'))

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
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page">
						<span class="breadcrumb__item-link">
							@lang('Shopping Cart')
						</span>
					</li>
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
			<h1 class="block-header__title">@lang('Shopping Cart')</h1>
		</div>
	</div>
</div>
<div class="block">
	<div class="container">
		<div class="cart">
			<div class="cart__table cart-table">
				<table class="cart-table__table">
					<thead class="cart-table__head">
						<tr class="cart-table__row">
							<th class="cart-table__column cart-table__column--image">@lang('Image')</th>
							<th class="cart-table__column cart-table__column--product">@lang('Part')</th>
							<th class="cart-table__column cart-table__column--price">@lang('Price')</th>
							<th class="cart-table__column cart-table__column--quantity">@lang('Quantity')</th>
							<th class="cart-table__column cart-table__column--total">@lang('Total')</th>
							<th class="cart-table__column cart-table__column--remove"></th>
						</tr>
					</thead>
					<tbody class="cart-table__body">
						@foreach ($cart as $item)
						<tr class="cart-table__row">
							<td class="cart-table__column cart-table__column--image">
								<a href="{{ route('part', ['part' => $item->model]) }}">
									<img src="{{ secure_asset($item->model->image) }}" alt="@lang('Photo')">
								</a>
							</td>
							<td class="cart-table__column cart-table__column--product">
								<a href="{{ route('part', ['part' => $item->model]) }}" class="cart-table__product-name">
									{{ $item->title }}
								</a>
								<ul class="cart-table__options">
									<li>
										@lang('Color'): Yellow
									</li>
									<li>
										@lang('Material'): Aluminium
									</li>
								</ul>
							</td>
							<td class="cart-table__column cart-table__column--price" data-title="@lang('Price')">
								{{ $item->price }} DZD
							</td>
							<td class="cart-table__column cart-table__column--quantity" data-title="@lang('Quantity')">
								<div class="cart-table__quantity input-number">
									<input class="form-control input-number__input" type="number" min="1" value="{{ $item->qty }}">
									<div class="input-number__add"></div>
									<div class="input-number__sub"></div>
								</div>
							</td>
							<td class="cart-table__column cart-table__column--total" data-title="@lang('Total')">
								{{ Cart::total() }} DZD
							</td>
							<td class="cart-table__column cart-table__column--remove">
								<button type="button" class="cart-table__remove btn btn-sm btn-icon btn-muted">
									@include('svg.X')
								</button>
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot class="cart-table__foot">
						<tr>
							<td colspan="6">
								<div class="cart-table__actions">
									<form class="cart-table__coupon-form form-row">
										<div class="form-group mb-0 col flex-grow-1">
											<input type="text" class="form-control form-control-sm" placeholder="@lang('Coupon Code')">
										</div>
										<div class="form-group mb-0 col-auto">
											<button type="button" class="btn btn-sm btn-primary">
												@lang('Apply Coupon')
											</button>
										</div>
									</form>
									<div class="cart-table__update-button">
										<a class="btn btn-sm btn-primary" href="#">
											@lang('Update Cart')
										</a>
									</div>
								</div>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="cart__totals">
				<div class="card">
					<div class="card-body card-body--padding--2">
						<h3 class="card-title">@lang('Cart Totals')</h3>
						<table class="cart__totals-table">
							<tr>
								<th>@lang('Total')</th>
								<td>{{ Cart::total() }}</td>
							</tr>
						</table>
						<a class="btn btn-primary btn-xl btn-block" href="#">
							@lang('Proceed to checkout')
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
@stop
