<div class="block-zone__card category-card category-card--layout--overlay">
	<div class="category-card__body">
		<div class="category-card__content">
			<div class="category-card__info">
				<div class="category-card__name">
					<a href="{{ route('category', ['category' => $category]) }}">
						{{ $category->name }}
					</a>
				</div>
				<ul class="category-card__children">
					@foreach ($category->categories->take(7) as $category)
						<li>
							<a href="{{ route('category', ['category' => $category]) }}">
								{{ $category->name }}
							</a>
						</li>
					@endforeach
				</ul>
				<div class="category-card__actions">
					<a href="{{ route('category', ['category' => $category]) }}" class="btn btn-primary btn-sm">
						@lang('Shop All')
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
