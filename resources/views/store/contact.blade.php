@extends('layouts.app')

@section('title', __('Contact US'))

@section('content')
<div class="block-map block">
	<div class="block-map__body">
		<iframe src="https://maps.google.com/maps?q={{ $contact->latitude }},{{ $contact->longitude }}&hl=es;z=14&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
	</div>
</div>
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
					<li class="breadcrumb__item">
						<a href="{{ route('store', ['store' => $store]) }}" class="breadcrumb__item-link">
							{{ $store->name }}
						</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page">
						<span class="breadcrumb__item-link">
							@lang('Contact US')
						</span>
					</li>
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
			<h1 class="block-header__title">@lang('Contact US')</h1>
		</div>
	</div>
</div>
<div class="block">
	<div class="container container--max--lg">
		<div class="card">
			<div class="card-body card-body--padding--2">
				<div class="row">
					<div class="col-12 col-lg-12 pb-4 pb-lg-0">
						<div class="mr-1">
							<h4 class="contact-us__header card-title">@lang('Our Address')</h4>
							<div class="contact-us__address">
								<p>
									{{ $contact->address }}<br>
									@lang('Email Address'): {{ $contact->email }}<br>
									@lang('Phone Number'): {{ $contact->phone }}
								</p>
								<p>
									<strong>@lang('Opening Hours')</strong><br>
									@foreach ($contact->opening_hours as $day => $hours)
										{{ __(ucfirst($day)) }}:
										@if(empty($hours))
											@lang('Closed') <br>
										@else
										@foreach ($hours as $hour)
											{{ $hour }}
										@endforeach <br>
										@endif
									@endforeach
								</p>
								<p>
									{!! $contact->comment !!}
								</p>
							</div>
						</div>
					</div>
					{{-- <div class="col-12 col-lg-6">
						<div class="ml-1">
							<h4 class="contact-us__header card-title">@lang('Leave us a Message')</h4>
							@if ($errors->any())
							<div class="alert alert-danger" id="errors">
								<ul>
									@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
							@endif
							@if(session()->exists('success'))
							<div class="alert alert-success" role="alert" id="success">
								<p>@lang('Your message has been sent! We will be in touch as soon as possible.')</p>
							</div>
							@endif
							<form action="/contact" method="POST" role="form" accept-charset="UTF-8">
								@csrf
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="form-name">@lang('Your Name')</label>
										<input type="text" id="form-name" name="name" class="form-control" placeholder="@lang('Your Name')"
											value="{{ old('name') }}" required>
										@error('name')
										<span class="invalid-feedback" role="alert" style="display: block;">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group col-md-6">
										<label for="form-email">@lang('Email')</label>
										<input type="email" id="form-email" name="contact_email" class="form-control"
											placeholder="@lang('Email Address')" value="{{ old('contact_email') }}" required>
										@error('contact_email')
										<span class="invalid-feedback" role="alert" style="display: block;">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="form-group">
									<label for="form-subject">@lang('Subject')</label>
									<input type="text" id="form-subject" name="subject" class="form-control"
										placeholder="@lang('Subject')" value="{{ old('subject') }}" required>
									@error('subject')
									<span class="invalid-feedback" role="alert" style="display: block;">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="form-group">
									<label for="form-message">@lang('Message')</label>
									<textarea id="form-message" name="message" class="form-control" rows="4" required></textarea>
									@error('message')
									<span class="invalid-feedback" role="alert" style="display: block;">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<button type="submit" class="btn btn-primary">@lang('Send Message')</button>
							</form>
						</div>
					</div> --}}
				</div>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
@stop
