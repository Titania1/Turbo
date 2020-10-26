@extends('layouts.app')

@section('title', config('app.name'))

@section('content')
<div class="block-space block-space--layout--after-header"></div>
@include('partials.new_arrivals')
{{-- @include('partials.index.features') --}}
@include('partials.index.featured')
@foreach ($categories as $category)
	@include('partials.index.category_block')
@endforeach
{{-- @include('partials.index.parts') --}}
@include('partials.index.banners')
@stop
