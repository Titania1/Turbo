@extends('layouts.app')

@section('title', __('Dashboard'))

@section('content')
<div class="container container--max--xl">
	<div class="row">
		<div class="col-12 col-lg-3 d-flex">
			@include('partials.account_navigation', ['active' => 'dashboard'])
		</div>
		<div class="col-12 col-lg-9 mt-4 mt-lg-0">
			<div class="dashboard">
				<div class="dashboard__profile card profile-card">
					<div class="card-body profile-card__body">
						<div class="profile-card__avatar">
							<img src="{{ $user->dashboardAvatar }}" alt="@lang('Avatar')" width="90" height="90">
						</div>
						<div class="profile-card__name">{{ $user->name }}</div>
						<div class="profile-card__email">{{ $user->email }}</div>
						<div class="profile-card__edit">
							<a href="/profile" class="btn btn-secondary btn-sm">
								@lang('Edit Profile')
							</a>
						</div>
					</div>
				</div>
				<div class="dashboard__address card address-card address-card--featured">
					<div class="address-card__badge tag-badge tag-badge--theme">
						@lang('Default')
					</div>
					<div class="address-card__body">
						<div class="address-card__name">{{ $user->name }}</div>
						<div class="address-card__row">{{ optional($profile)->address }}</div>
						@if (optional($user->profile)->phone)
						<div class="address-card__row">
							<div class="address-card__row-title">
								@lang('Phone Number')
							</div>
							<div class="address-card__row-content">
								{{ optional($user->profile)->phone }}
							</div>
						</div>
						@endif
						<div class="address-card__row">
							<div class="address-card__row-title">@lang('Email Address')</div>
							<div class="address-card__row-content">{{ $user->email }}</div>
						</div>
						<div class="address-card__footer"><a href="#">@lang('Edit Address')</a></div>
					</div>
				</div>
				@if($user->orders->isNotEmpty())
				<div class="dashboard__orders card">
					<div class="card-header">
						<h5>@lang('Recent Orders')</h5>
					</div>
					<div class="card-divider"></div>
					<div class="card-table">
						<div class="table-responsive-sm">
							<table>
								<thead>
									<tr>
										<th>@lang('Order')</th>
										<th>@lang('Date')</th>
										<th>@lang('Status')</th>
										<th>@lang('Total')</th>
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
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@stop
