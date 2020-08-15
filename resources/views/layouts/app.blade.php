<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title') | {{ config('app.name') }}</title>

	<!-- Scripts -->
	<script src="{{ secure_asset('js/app.js') }}" defer></script>

	<link rel="icon" type="image/png" href="/images/favicon.png"><!-- fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i"><!-- css -->
	<link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="/vendor/owl-carousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="/vendor/photoswipe/photoswipe.css">
	<link rel="stylesheet" href="/vendor/photoswipe/default-skin/default-skin.css">
	<link rel="stylesheet" href="/vendor/select2/css/select2.min.css">
	<!-- Styles -->
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/header.css" media="(min-width: 1200px)">
	{{-- <link rel="stylesheet" href="/css/rtl.css">
	<link rel="stylesheet" href="/css/header-rtl.css" media="(min-width: 1200px)"> --}}
	<link rel="stylesheet" href="/css/mobile-header.css" media="(max-width: 1199px)">
	<!-- font - fontawesome -->
	<link rel="stylesheet" href="/vendor/fontawesome/css/all.min.css">

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	@stack('styles')
</head>

<body>
	<noscript>
	@lang('For full functionality of this site it is necessary to enable JavaScript. Here are the :link instructions how to enable JavaScript in your web browser', ['link' => '<a href="https://www.enable-javascript.com/">'])</a>.
	<style>#app {display:none;}</style>
	</noscript>
	<!-- site -->
	<div class="site" id="app">
		@include('layouts.mobile_header')
		@include('layouts.header')
		<!-- site__body -->
		<div class="site__body">
			@yield('content')
		</div><!-- site__body / end -->
		@include('layouts.footer')
	</div><!-- site / end -->
	@include('partials.mobile_menu')
	<!-- quickview-modal -->
	<div id="quickview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>
	<!-- quickview-modal / end -->
	@include('partials.add_vehicle_modal')
	@include('partials.vehicle_picker_modal')
	@include('partials.photoswipe')
	<!-- scripts -->
	<script src="/vendor/jquery/jquery.min.js"></script>
	<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="/vendor/owl-carousel/owl.carousel.min.js"></script>
	<script src="/vendor/nouislider/nouislider.min.js"></script>
	<script src="/vendor/photoswipe/photoswipe.min.js"></script>
	<script src="/vendor/photoswipe/photoswipe-ui-default.min.js"></script>
	<script src="/vendor/select2/js/select2.min.js"></script>
	<script src="/js/number.js"></script>
	<script src="/js/main.js"></script>
	@stack('scripts')
</body>

</html>
