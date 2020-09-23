@extends('layouts.app')

@section('title', __('Shop'))

@section('content')
<div class="container container--max--xl">
	<div class="row">
		<div class="col-12 col-lg-3 d-flex">
			@include('partials.account_navigation', ['active' => 'shop'])
		</div>
		<div class="col-12 col-lg-9 mt-4 mt-lg-0">
			<div class="card">
				<div class="card-header">
					<h5>@lang('Shop')</h5>
				</div>
				<div class="card-divider"></div>
				<div class="card-body card-body--padding--2">
					<div class="vehicles-list vehicles-list--layout--account">
						<div class="vehicles-list__body">
							@foreach ($parts as $part)

							<div class="vehicles-list__item">
								<div class="vehicles-list__item-info">
									<div class="vehicles-list__item-name">
										{{ $part->title }}
									</div>
									<div class="vehicles-list__item-details">
										{{ $part->excerpt }}
									</div>
									<div class="vehicles-list__item-links">
										<a href="{{ route('part', ['part' => $part]) }}">@lang('Show Part')</a>
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
					<h5 @click="addPart = !addPart" class="add_part_button">@lang('Add a part')</h5>
				</div>
				<div class="card-divider"></div>
				<div class="card-body card-body--padding--2" v-show="addPart">
					<form action="{{ route('part.add') }}" method="post" enctype="multipart/form-data" role="form">
						@csrf
						<div class="vehicle-form vehicle-form--layout--account">
							<div class="vehicle-form__item vehicle-form__item--select">
								<select class="form-control form-control-select2" aria-label="@lang('Vehicle')" name="vehicle">
									<option value="none">@lang('Select Vehicle')</option>
									@foreach ($vehicles as $vehicle)
									<option value="{{ $vehicle->id }}" @if(old('vehicle')==$vehicle->id) selected @endif>
										{{ $vehicle->model }}
									</option>
									@endforeach
								</select>
								@error('vehicle')
								<span class="invalid-feedback" role="alert" style="display: block;">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="vehicle-form__item vehicle-form__item--select">
								<select class="form-control form-control-select2" aria-label="@lang('Category')" id="select-category"
									name="category">
									<option value="none">@lang('Select Category')</option>
									@foreach ($categories as $category)
									<option value="{{ $category->id }}">{{ $category->name }}</option>
									@endforeach
								</select>
								@error('category')
								<span class="invalid-feedback" role="alert" style="display: block;">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="vehicle-form__item vehicle-form__item--select">
								<select class="form-control form-control-select2" aria-label="@lang('Type')" disabled id="select-type"
									name="type">
									<option value="null" selected>@lang('Select Type')</option>
								</select>
								@error('type')
								<span class="invalid-feedback" role="alert" style="display: block;">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="vehicle-form__divider">@lang('Part Details')</div>
							<div class="vehicle-form__item">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="form-title">@lang('Title')</label>
										<input type="text" id="form-title" name="title" class="form-control"
											placeholder="@lang('Designation of part')" value="{{ old('title') }}" required>
										@error('title')
										<span class="invalid-feedback" role="alert" style="display: block;">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group col-md-6">
										<label for="form-price">@lang('Price')</label>
										<input type="number" id="form-price" name="price" class="form-control"
											placeholder="@lang('Part Price')" value="{{ old('price') }}" required>
										@error('price')
										<span class="invalid-feedback" role="alert" style="display: block;">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="form-row">
									<label for="description">@lang('Description')</label>
									<textarea name="description" class="form-control" id="description" rows="4"></textarea>
									@error('description')
									<span class="invalid-feedback" role="alert" style="display: block;">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="sku">@lang('Reference')</label>
										<input type="text" name="sku" id="sku" class="form-control" placeholder="@lang('Reference')"
											value="{{ old('sku') }}">
										@error('sku')
										<span class="invalid-feedback" role="alert" style="display: block;">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group col-md-6">
										<label for="image">@lang('Image')</label>
										<input type="file" name="image" id="image" class="form-control" placeholder="@lang('Image')"
											value="{{ old('image') }}">
										@error('image')
										<span class="invalid-feedback" role="alert" style="display: block;">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="form-row">
									<label for="key-features">@lang('Key Features')</label>
									@error('key_features')
									<span class="invalid-feedback" role="alert" style="display: block;">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<key-features />
							</div>
						</div>
						<div class="mt-4 pt-3">
							<button type="submit" class="btn btn-sm btn-primary">@lang('Add')</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
