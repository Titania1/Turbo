@extends('layouts.app')

@section('title', __('Page Not Found'))

@section('content')
<div class="block-space block-space--layout--spaceship-ledge-height"></div>
<div class="block">
	<div class="container">
		<div class="not-found">
			<div class="not-found__404">Oops! @lang('Error') 404</div>
			<div class="not-found__content">
				<h1 class="not-found__title">@lang('Page Not Found')</h1>
				<p class="not-found__text">@lang('We can\'t seem to find the page you\'re looking for.')<br>
					@lang('Try to use the search.')</p>
				<form class="not-found__search">
					<input type="text" class="not-found__search-input form-control" placeholder="@lang('Search Query...')"> <button type="submit" class="not-found__search-button btn btn-primary">@lang('Search')</button>
				</form>
				<p class="not-found__text">@lang('Or go to the home page to start over.')</p><a class="btn btn-secondary btn-sm" href="/">@lang('Go To Home Page')</a>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
@stop
