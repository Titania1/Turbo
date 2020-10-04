@extends('layouts.app')

@section('title', "$brand->name $model->name $vehicle->name . $engine->type")

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
						<a href="{{ route('brand', $brand) }}" class="breadcrumb__item-link">
							{{ $brand->name }}
						</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--parent">
						<a href="#" class="breadcrumb__item-link">
							{{ $model->name }}
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
			@include('partials.info_panel')
			<h1 class="block-header__title">Sections de pièces: {{ "$brand->name $vehicle->name" }}</h1>
		</div>
	</div>
</div>
<div class="block block-split block-split--has-sidebar">
	<div class="container">
		<div class="block-split__row row no-gutters">
			<div class="block-split__item block-split__item-content col-auto">
				<div class="block">
					<div class="categories-list categories-list--layout--columns-4-sidebar">
						<ul class="categories-list__body">
							@foreach ($categories as $category)
							<li class="categories-list__item">
								<a href="{{ route('category', $category) }}">
									<img src="{{ secure_asset('storage/' . $category->image) }}" alt="@lang('Photo')">
									<div class="categories-list__item-name">
										{{ $category->name }}
									</div>
								</a>
								<div class="categories-list__item-products">
									{{ $category->products_count }} @lang('Products')
								</div>
							</li>
							<li class="categories-list__divider"></li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="block-space block-space--layout--divider-nl"></div>
				<div class="block-space block-space--layout--before-footer"></div>
			</div>
			<div class="block-split__item block-split__item-sidebar col-auto">
				<div class="card widget widget-categories-list">
					<div class="widget-categories-list__body" data-collapse="" data-collapse-opened-class="widget-categories-list--open">
						<ul class="widget-categories-list__root">
							@foreach ($sidebar_categories as $category => $sub_categories)
							<li class="widget-categories-list__root-item widget-categories-list__root-item--has-children" data-collapse-item="">
								<a type="button" class="widget-categories-list__show-more widget-categories-list__root-link" data-collapse-trigger="">
									<span class="widget-categories-list__show-more-expand-text">
										{{ $sub_categories->first()->category->name }}
									</span>
									<span class="widget-categories-list__show-more-collapse-text">
										{{ $sub_categories->first()->category->name }}
									</span>
									<span class="widget-categories-list__show-more-arrow">
										@include('svg.button_arrow')
									</span>
								</a>
								{{-- Don't remove this, necessary to fill --}}
								<ul class="widget-categories-list__child"></ul>
								<ul class="widget-categories-list__child" data-collapse-content="">
									@foreach ($sub_categories as $category)
										<li class="widget-categories-list__child-item">
											<a href="#" class="widget-categories-list__child-link">
												{{ $category->name }}
											</a>
										</li>
									@endforeach
								</ul>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
