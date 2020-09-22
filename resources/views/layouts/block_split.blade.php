@extends('layouts.app')

@section('content')
@include('layouts.breadcrumb')
<div class="block block-split">
	<div class="container">
		<div class="block-split__row row no-gutters">
			<div class="block-split__item block-split__item-content col-auto">
				<div class="block">@yield('block')</div>
			</div>
		</div>
	</div>
</div>
@stop
