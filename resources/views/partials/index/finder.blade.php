<div class="block-finder block" id="finder" style="display: none;">
	<div class="decor block-finder__decor decor--type--bottom">
		<div class="decor__body">
			<div class="decor__start"></div>
			<div class="decor__end"></div>
			<div class="decor__center"></div>
		</div>
	</div>
	<div class="block-finder__image" style="background-image: url('/images/finder-1903x500.jpg');"></div>
	<div class="block-finder__body container container--max--xl">
		<div class="block-finder__title">
			@lang('Find Parts For Your Vehicle')
		</div>
		<div class="block-finder__subtitle">
			@lang('Over hundreds of brands and tens of thousands of parts')
		</div>
		<form class="block-finder__form" action="{{ route('search') }}" method="POST" role="form">
			@csrf
			<div class="block-finder__form-control block-finder__form-control--select">
				<select name="year" aria-label="@lang('Vehicle Year')" id="select-year" required>
					<option value="none">@lang('Select Year')</option>
					@foreach ($years as $year)
					<option value="{{ $year }}">{{ $year }}</option>
					@endforeach
				</select>
				@error('year')
				<span class="invalid-feedback" role="alert" style="display: block;">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<div class="block-finder__form-control block-finder__form-control--select">
				<select name="brand" aria-label="@lang('Vehicle Brand')" disabled="disabled" id="select-brand" required>
					<option value="none" selected>@lang('Sélectionnez la marque')</option>
				</select>
				@error('brand')
				<span class="invalid-feedback" role="alert" style="display: block;">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<div class="block-finder__form-control block-finder__form-control--select">
				<select name="model" aria-label="@lang('Vehicle Model')" disabled="disabled" id="select-model" required>
					<option value="none">@lang('Select Model')</option>
				</select>
				@error('model')
				<span class="invalid-feedback" role="alert" style="display: block;">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<div class="block-finder__form-control block-finder__form-control--select">
				<select name="fuel" aria-label="@lang('Vehicle Engine')" disabled="disabled" id="select-fuel" required>
					<option value="none" selected>@lang('Select Engine')</option>
				</select>
				@error('fuel')
				<span class="invalid-feedback" role="alert" style="display: block;">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<button class="block-finder__form-control block-finder__form-control--button" type="submit"
				id="submit-search" disabled>
				@lang('Search')
			</button>
		</form>
	</div>
</div>

@push('styles')
@endpush

@push('scripts')
	<script src="/js/finder.js"></script>
@endpush
