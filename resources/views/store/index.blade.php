@extends('layouts.app')

@section('title', $store->name)

@section('content')
<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first">
						<a href="/" class="breadcrumb__item-link">
							@lang('Home')
						</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page">
						<span class="breadcrumb__item-link">
							{{ $store->name }}
						</span>
					</li>
					@if($store->has('contact')->exists())
					<li class="store_link breadcrumb__item--parent breadcrumb__item--first">
						<a href="{{ route('store.contact', ['store' => $store]) }}" class="breadcrumb__item-link">
							@lang('Contact US')
						</a>
					</li>
					@endif
					@if($store->has('about')->exists())
					<li class="store_link breadcrumb__item--parent breadcrumb__item--first">
						<a href="{{ route('store.about', ['store' => $store]) }}" class="breadcrumb__item-link">
							@lang('About')
						</a>
					</li>
					@endif
				</ol>
			</nav>
			<h1 class="block-header__title">{{ $store->name }}</h1>
		</div>
	</div>
</div>
<div class="block block-split">
	<div class="container">
		<div class="block-split__row row no-gutters">
			<div class="block-split__item block-split__item-content col-auto">
				<div class="block">
					<div class="categories-list categories-list--layout--columns-6-full">
						<ul class="categories-list__body"></ul>
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
								@foreach ($store->user->parts as $part)
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
			</div>
		</div>
		<div class="block-space block-space--layout--before-footer"></div>
	</div>
</div>
@stop
