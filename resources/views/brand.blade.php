@extends('layouts.block_split')

@section('title', $brand->name)

@section('block')
<div class="categories-list categories-list--layout--columns-6-full">
	<ul class="categories-list__body">
		@foreach($models as $model)
			<li class="categories-list__item">
				{{-- <a href="{{ url("brands/$brand->id/$brand->slug/models/$model->id/$model->slug") }}"> --}}
					<img src="{{ $model->image }}" alt="@lang('Photo')">
					<div class="categories-list__item-name">
						{{ $model->name }}
					</div>
				{{-- </a> --}}
				<div class="categories-list__item-products">{{ $model->vehicles()->count() }}</div>
				<div class="form-group">
					<select class="form-control form-control-sm form-control-select2">
						<option>@lang('Select Model')</option>
						@foreach($model->vehicles as $vehicle)
							<option value="{{ url("brands/$brand->id/$brand->slug/models/$model->id/$model->slug/vehicles/$vehicle->id/$vehicle->slug") }}">
								{{ $vehicle->name }}
							</option>
						@endforeach
					</select>
				</div>
			</li>
			<li class="categories-list__divider"></li>
		@endforeach
	</ul>
	<div class="reviews-list__pagination">
		{{ $models->links() }}
	</div>
</div>
@stop
