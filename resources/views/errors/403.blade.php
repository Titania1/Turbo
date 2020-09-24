@extends('layouts.app')

@section('title', __('Access Forbidden'))

@section('content')
<div class="block-space block-space--layout--spaceship-ledge-height"></div>
<div class="block">
	<div class="container">
	<div class="not-found">
	<div class="not-found__403">Oops! @lang('Error') 403</div>
	<div class="not-found__content">
	<h1 class="not-found__title">@lang('Access Forbidden')</h1>
	<p class="not-found__text">@lang('Access Forbidden')<br></p>

	<p class="not-found__text">@lang('Or go to the home page to start over.')</p><a
	class="btn btn-secondary btn-sm" href="/">@lang('Go To Home Page')</a>
	</div>
	</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
@stop
