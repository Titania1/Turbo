@extends('layouts.app')

@section('title', __('Home'))

@section('content')
@include('partials.index.features')
<div class="block-space block-space--layout--divider-nl"></div>
@include('partials.index.featured')
<div class="block-space block-space--layout--divider-nl"></div>
@foreach ($categories as $category)
@include('partials.index.category_block')
@endforeach
@include('partials.index.banners')
<div class="block-space block-space--layout--divider-nl"></div>
{{-- @include('partials.new_arrivals') --}}
<div class="block-space block-space--layout--divider-nl d-xl-block d-none"></div>
{{-- @include('partials.index.parts') --}}
<div class="block-space block-space--layout--before-footer"></div>
@stop

@push('styles')
<link rel="stylesheet" href="/css/index.css">
@endpush
