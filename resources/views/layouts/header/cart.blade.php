<div class="indicator indicator--trigger--click">
	<a href="/cart" class="indicator__button">
		<span class="indicator__icon">
			@include('svg.cart')
			<span class="indicator__counter">{{ $cart->count() }}</span>
		</span>
		<span class="indicator__title">@lang('Shopping Cart')</span>
		<span class="indicator__value">{{ Cart::total(0)}}DZA</span>

	</a>
	<div class="indicator__content">
		<div class="dropcart">
			<ul class="dropcart__list">
				@foreach ($cart as $item)
				<li class="dropcart__item">
					<div class="dropcart__item-image">
						<a href="{{ route('part', ['part' => $item->model]) }}">
							<img src="{{ secure_asset($item->model->cartHeaderImage) }}" alt="@lang('Image')" width="70" height="70">
						</a>
					</div>
					<div class="dropcart__item-info">
						<div class="dropcart__item-name">
							<a href="{{ route('part', ['part' => $item->model]) }}">
								{{ $item->model->title }}
							</a>
						</div>
						<ul class="dropcart__item-features">
							<li>@lang('Color'): Yellow</li>
							<li>@lang('Material'): Aluminium</li>
						</ul>
						<div class="dropcart__item-meta">
							<div class="dropcart__item-quantity">{{ $item->qty }}</div>
							<div class="dropcart__item-price">{{ $item->price * $item->qty }} DZD</div>
						</div>
					</div>
					<form action="{{ route('cart.remove', ['part' => $item->rowId]) }}" method="post">
						@csrf
						<button type="submit" class="dropcart__item-remove">
							@include('svg.remove')
						</button>
					</form>
				</li>
				@endforeach
				<li class="dropcart__divider" role="presentation"></li>
			</ul>
			<div class="dropcart__totals">
				<table>
					<tr>
						<th>@lang('Total')</th>
						<td>{{ Cart::total() }} DZD</td>
					</tr>
				</table>
			</div>
			<div class="dropcart__actions">
				<a href="/cart" class="btn btn-secondary">
					@lang('View Cart')
				</a>
				<a href="/checkout" class="btn btn-primary">@lang('Checkout')</a>
			</div>
		</div>
	</div>
</div>
