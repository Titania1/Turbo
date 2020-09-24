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
						<a href="#" class="breadcrumb__item-link">
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
			<h1 class="block-header__title">Sections de pièces: ALFA ROMEO GIULIA 105</h1>
		</div>
	</div>
</div>
<div class="block block-split">
	<div class="container">
		<div class="block-split__row row no-gutters">
			<div class="block-split__item block-split__item-content col-auto">
				<div class="block">
					<div class="categories-list categories-list--layout--columns-4-full">
						<ul class="categories-list__body">
							@foreach ($categories as $category)
								<li class="categories-list__item">
									<a href="#">
										<img src="images/categories/category-1-200x200.jpg" alt="">
										<div class="categories-list__item-name">
											{{ $category->name }}
										</div>
									</a>
									<div class="categories-list__item-products">131 Products</div>
								</li>
								<li class="categories-list__divider"></li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="block-space block-space--layout--divider-nl"></div>
				<div class="block-space block-space--layout--before-footer"></div>
			</div>
		</div>
	</div>
</div>
@stop
