@extends('layouts.app')

@section('title', __('Orders'))

@section('content')
<div class="container container--max--xl">
	<div class="row">
		<div class="col-12 col-lg-3 d-flex">
			@include('partials.account_navigation', ['active' => 'orders'])
		</div>
		<div class="col-12 col-lg-9 mt-4 mt-lg-0">
			<div class="card">
				<div class="card-header">
					<h5>Order History</h5>
				</div>
				<div class="card-divider"></div>
				<div class="card-table">
					<div class="table-responsive-sm">
						<table>
							<thead>
								<tr>
									<th>Order</th>
									<th>Date</th>
									<th>Status</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($orders as $order)
									<tr>
										<td><a href="{{ url(config('nova.path') . '/resources/orders/' . $order->id) }}">#{{ $order->id }}</a></td>
										<td>{{ $order->created_at->format('d F, Y') }}</td>
										<td>{{ $order->status }}</td>
										<td>$2,719.00 @lang('for') {{ $order->parts->count() }} item(s)</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-divider"></div>
				<div class="card-footer">
					{{ $orders->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@stop
