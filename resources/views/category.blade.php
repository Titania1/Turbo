@extends('layouts.app')

@section('title', $category->name)

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
							{{ $category->name }}
						</span>
					</li>
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
			<h1 class="block-header__title">{{ $category->name }}</h1>
		</div>
	</div>
</div>
<div class="block block-split">
	<div class="container">
		<div class="block-split__row row no-gutters">
			<div class="block-split__item block-split__item-content col-auto">
				<div class="block">
					<div class="categories-list categories-list--layout--columns-6-full">
						<ul class="categories-list__body">
						{{-- if the category has a parent, then show the types --}}
						@if($category->parent)
							@foreach ($category->types as $type)
								<li class="categories-list__item">
									<a href="{{ route('type', ['type' => $type]) }}">
										<img src="{{ secure_asset($type->subCategoryImage) }}" alt="@lang('Photo')" width="148" height="148">
										<div class="categories-list__item-name">
											{{ $type->name }}
										</div>
									</a>
									<div class="categories-list__item-products">
										{{-- Count the parts of said type --}}
										{{ $type->parts()->count() }} @lang('Parts')
									</div>
								</li>
								<li class="categories-list__divider"></li>
							@endforeach
						@else
							@foreach ($category->categories as $sub_category)
								<li class="categories-list__item">
									<a href="{{ route('category', ['category' => $sub_category]) }}">
										<img src="{{ secure_asset($sub_category->subCategoryImage) }}" alt="@lang('Photo')" width="148" height="148">
										<div class="categories-list__item-name">
											{{ $sub_category->name }}
										</div>
									</a>
									<div class="categories-list__item-products">
										{{-- Count the parts of said type --}}
										{{ $sub_category->parts()->count() }} @lang('Parts')
									</div>
								</li>
								<li class="categories-list__divider"></li>
							@endforeach
						@endif
						</ul>
					</div>
				</div>
				<div class="block-space block-space--layout--divider-nl"></div>
				<div class="block block-products-carousel" data-layout="grid-5">
					<div class="container">
						<div class="section-header">
							<div class="section-header__body">
								<h2 class="section-header__title">@lang('Parts')</h2>
								<div class="section-header__spring"></div>
								<div class="section-header__arrows">
									<div class="arrow section-header__arrow section-header__arrow--prev arrow--prev">
										<button class="arrow__button" type="button">
											@include('svg.arrow_left')
										</button>
									</div>
									<div class="arrow section-header__arrow section-header__arrow--next arrow--next">
										<button class="arrow__button" type="button">
											@include('svg.arrow_right')
										</button>
									</div>
								</div>
								<div class="section-header__divider"></div>
							</div>
						</div>
						<div class="block-products-carousel__carousel">
							<div class="block-products-carousel__carousel-loader"></div>
							<div class="owl-carousel">
								@foreach ($category->parts as $part)
									<div class="block-products-carousel__column">
										<div class="block-products-carousel__cell">
											<div class="product-card product-card--layout--grid">
												@include('partials.part_card')
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				<div class="block-space block-space--layout--divider-nl"></div>
				@include('partials.category_featured')
				<div class="block-space block-space--layout--divider-nl"></div>
				@include('partials.brands')
			</div>
		</div>
		<div class="block-space block-space--layout--before-footer"></div>
	</div>
</div>
@stop
