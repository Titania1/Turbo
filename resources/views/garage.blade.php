@extends('layouts.app')

@section('title', __('Garage'))

@section('content')
<div class="container container--max--xl">
	<div class="row">
		<div class="col-12 col-lg-3 d-flex">
			@include('partials.account_navigation', ['active' => 'garage'])
		</div>
		<div class="col-12 col-lg-9 mt-4 mt-lg-0">
			<div class="card">
				<div class="card-header">
					<h5>@lang('Garage')</h5>
				</div>
				<div class="card-divider"></div>
				<div class="card-body card-body--padding--2">
					<div class="vehicles-list vehicles-list--layout--account">
						<div class="vehicles-list__body">
							@foreach ($garage->vehicles as $vehicle)
								<div class="vehicles-list__item">
									<div class="vehicles-list__item-info">
										<div class="vehicles-list__item-name">
											2011 Ford Focus S
										</div>
										<div class="vehicles-list__item-details">
											Engine 2.0L 1742DA L4 FI Turbo
										</div>
										<div class="vehicles-list__item-links">
											<a href="#">@lang('Show Parts')</a>
										</div>
									</div>
									<button type="button" class="vehicles-list__item-remove">
										@include('svg.trash')
									</button>
								</div>
							@endforeach
						</div>
					</div>
				</div>
				<div class="card-divider"></div>
				<div class="card-header">
					<h5>@lang('Add A Vehicle')</h5>
				</div>
				<div class="card-divider"></div>
				<div class="card-body card-body--padding--2">
					<div class="vehicle-form vehicle-form--layout--account">
						<div class="vehicle-form__item vehicle-form__item--select"><select class="form-control form-control-select2" aria-label="@lang('Year')">
								<option value="none">@lang('Select Year')</option>
								<option>2010</option>
								<option>2011</option>
								<option>2012</option>
								<option>2013</option>
								<option>2014</option>
								<option>2015</option>
								<option>2016</option>
								<option>2017</option>
								<option>2018</option>
								<option>2019</option>
								<option>2020</option>
							</select></div>
						<div class="vehicle-form__item vehicle-form__item--select"><select class="form-control form-control-select2" aria-label="@lang('Brand')" disabled="disabled">
								<option value="none">@lang('Select Brand')</option>
								<option>Audi</option>
								<option>BMW</option>
								<option>Ferrari</option>
								<option>Ford</option>
								<option>KIA</option>
								<option>Nissan</option>
								<option>Tesla</option>
								<option>Toyota</option>
							</select></div>
						<div class="vehicle-form__item vehicle-form__item--select"><select class="form-control form-control-select2" aria-label="@lang('Model')" disabled="disabled">
								<option value="none">@lang('Select Model')</option>
								<option>Explorer</option>
								<option>Focus S</option>
								<option>Fusion SE</option>
								<option>Mustang</option>
							</select></div>
						<div class="vehicle-form__item vehicle-form__item--select"><select class="form-control form-control-select2" aria-label="Engine" disabled="disabled">
								<option value="none">@lang('Select Engine')</option>
								<option>Gas 1.6L 125 hp AT/L4</option>
								<option>Diesel 2.5L 200 hp AT/L5</option>
								<option>Diesel 3.0L 250 hp MT/L5</option>
							</select></div>
						<div class="vehicle-form__divider">@lang('Or')</div>
						<div class="vehicle-form__item"><input type="text" class="form-control" placeholder="@lang('Enter VIN number')" aria-label="@lang('VIN number')"></div>
					</div>
					<div class="mt-4 pt-3"><a href="#" class="btn btn-sm btn-primary">@lang('Add A Vehicle')</a></div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
