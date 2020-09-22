@extends('layouts.app')

@section('title', $brand->name)

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
							{{ $brand->name }}
						</span>
					</li>
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
			<h1 class="block-header__title">{{ $brand->name }}</h1>
		</div>
	</div>
</div>
<div class="block block-teammates">
	<div class="container container--max--xl">
		<div class="block-teammates__title">@lang('Select Model') {{ $brand->name }}</div>
		<div class="block-teammates__list">
			<div class="owl-carousel">
				@foreach($brand->models as $model)
					<div class="block-teammates__item teammate">
						<div class="teammate__avatar">
							<img src="{{ $model->picture }}" alt="@lang('Photo')">
						</div>
						<div class="teammate__info">
							<div class="teammate__name">{{ strtok($model->name, ' ') }}</div>
							@if($model->children->isNotEmpty())
								<div class="form-group">
									<select class="form-control form-control-sm form-control-select2">
										<option>@lang('Select Model')</option>
										<option value="{{ route('model', ['model' => $model]) }}">
											{{ $model->name }}
										</option>
										@foreach($model->children as $child)
											<option value="{{ route('model', ['model' => $model]) }}">
													{{ $child->name }}
											</option>
										@endforeach
									</select>
								</div>
							@else
								<div class="teammate__position">
									<a href="{{ route('model', ['model' => $model]) }}">
										{{ $model->name }}
									</a>
								</div>
								<div class="teammate__position">
									{{ $model->lifeSpan }}
								</div>
							@endif
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
@stop
