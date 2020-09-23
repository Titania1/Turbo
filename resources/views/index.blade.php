@extends('layouts.app')

@section('title', __('Home'))

@section('content')
@include('partials.new_arrivals')
@include('partials.index.features')
@include('partials.index.featured')
@foreach ($categories as $category)
	@include('partials.index.category_block')
@endforeach
@include('partials.index.banners')
{{-- @include('partials.index.parts') --}}
@stop

@push('styles')
<link rel="stylesheet" href="/css/index.css">
@endpush
