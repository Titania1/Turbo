@extends('layouts.app')

@section('title', __('Pricing'))

@section('content')
<section class="section primary pricing active" id="s-pricing">
	<div class="container">
		<header class="sep active">
			<div class="section-title">
				<h2>@lang('Our') <i>@lang('Pricing')</i></h2>
				<h3>@lang('Take a Look at Our Offers')</h3>
			</div>
			<p>Suspendisse tempus sodales neque, eget eleifend <a href="#">turpis tristique</a> eu. Nullam a nisl maximus, ultrices est ut blandit nislr, elit in lobortis mattis.</p>
		</header>
		<div class="row price-charts">
			<div class="span-4 price-chart-container col">
				<div class="price-chart free">
					<h4>@lang('Free')</h4>
					<h5>@lang('Our free package')</h5>
					<div class="price">
						<small>$</small><span>0</span>/mo
					</div>
					<ul>
						<li><span><i class="fa fa-database"></i> Diskspace</span><strong>1GB</strong></li>
						<li><span><i class="fa fa-group"></i> Bandwidth</span><strong>10GB</strong></li>
						<li><span><i class="fa fa-desktop"></i> Sub-domains</span><strong>1</strong></li>
						<li><span><i class="fa fa-envelope"></i> Emails</span><strong>5</strong></li>
						<li><span><i class="fa fa-support"></i> Support</span><strong>@lang('None')</strong></li>
					</ul>
					<div class="buy-now">
						<a href="#" class="button brand-1 full-width"><i class="fa fa-shopping-cart"></i> @lang('Get For Free')</a>
					</div>
				</div>
			</div>
			<div class="span-4 price-chart-container col">
				<div class="price-chart">
					<div class="ribbon ribbon-large">
						<div class="banner">
							<div class="text">@lang('Great Value')</div>
						</div>
					</div>
					<h4>@lang('Basic')</h4>
					<h5>@lang('Our basic package')</h5>
					<div class="price">
						<small>$</small><span>5</span>/mo
					</div>
					<ul>
						<li><span><i class="fa fa-database"></i> Diskspace</span><strong>5GB</strong></li>
						<li><span><i class="fa fa-group"></i> Bandwidth</span><strong>50GB</strong></li>
						<li><span><i class="fa fa-desktop"></i> Sub-domains</span><strong>10</strong></li>
						<li><span><i class="fa fa-envelope"></i> Emails</span><strong>50</strong></li>
						<li><span><i class="fa fa-support"></i> Support</span><strong>@lang('Yes')</strong></li>
					</ul>
					<div class="buy-now">
						<a href="#" class="button brand-1 full-width"><i class="fa fa-shopping-cart"></i> @lang('Buy Now')</a>
					</div>
				</div>
			</div>
			<div class="span-4 price-chart-container col">
				<div class="price-chart">
					<h4>Pro <i class="fa fa-trophy"></i></h4>
					<h5>@lang('Our pro package')</h5>
					<div class="price">
						<small>$</small><span>45</span>/mo
					</div>
					<ul>
						<li><span><i class="fa fa-database"></i> Diskspace</span><strong>500GB</strong></li>
						<li><span><i class="fa fa-group"></i> Bandwidth</span><strong>Unlimited</strong></li>
						<li><span><i class="fa fa-desktop"></i> Sub-domains</span><strong>500</strong></li>
						<li><span><i class="fa fa-envelope"></i> Emails</span><strong>Unlimited</strong></li>
						<li><span><i class="fa fa-support"></i> Support</span><strong>@lang('Yes')</strong></li>
					</ul>
					<div class="buy-now">
						<a href="#" class="button brand-1 full-width"><i class="fa fa-shopping-cart"></i> @lang('Buy Now')</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop

@push('styles')
	<link rel="stylesheet" href="/css/pricing.css">
@endpush
