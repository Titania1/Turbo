@extends('layouts.app')

@section('title', $vehicle->name)

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
							{{ $vehicle->name }}
						</span>
					</li>
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
			<h1 class="block-header__title">{{ $vehicle->name }}</h1>
		</div>
	</div>
</div>
<div class="block">
	<div class="container container--max--xl">
		<div>
			<table class="table table-bordered table-hover">
				<thead class="thead-dark">
					<tr class="wishlist__row--head">
						<th class="wishlist__column--head wishlist__column--price">
							@lang('Type')
						</th>
						<th class="wishlist__column--head wishlist__column--price">
							@lang('Construction interval')
						</th>
						<th class="wishlist__column--head wishlist__column--price">
							@lang('Power')
						</th>
						<th class="wishlist__column--head wishlist__column--price">
							@lang('Capacity')
						</th>
						<th class="wishlist__column--head wishlist__column--price">
							@lang('Number of cylinders')
						</th>
						<th class="wishlist__column--head wishlist__column--price">
							@lang('Body type')
						</th>
						<th class="wishlist__column--head wishlist__column--price">
							@lang('Engine type')
						</th>
						<th class="wishlist__column--head wishlist__column--price">
							@lang('Engine code')
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($engines as $engine)
						<tr class="wishlist__row--body">
							<td class="wishlist__column--body wishlist__column--price">
								<a href="{{ route('engine', ['engine' => $engine]) }}">
									{{ $engine->type }}
								</a>
							</td>
							<td class="wishlist__column--body wishlist__column--price">
								{{ $engine->interval }}
							</td>
							<td class="wishlist__column--body wishlist__column--price">
								{{ $engine->power }}
							</td>
							<td class="wishlist__column--body wishlist__column--price">
								{{ $engine->capacity }}
							</td>
							<td class="wishlist__column--body wishlist__column--price">
								{{ $engine->cylinders }}
							</td>
							<td class="wishlist__column--body wishlist__column--price">
								@lang($engine->body_type)
							</td>
							<td class="wishlist__column--body wishlist__column--price">
								@lang($engine->fuel)
							</td>
							<td class="wishlist__column--body wishlist__column--price">
								{{ $engine->motor_code }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
@stop
