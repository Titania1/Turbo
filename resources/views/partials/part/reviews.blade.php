<div class="product-tabs__pane @if(session('active_tab')) product-tabs__pane--active @endif" id="product-tab-reviews">
	<div class="reviews-view">
		<div class="reviews-view__list">
			<div class="reviews-list">
				<ol class="reviews-list__content">
					@foreach ($reviews as $review)
					<li class="reviews-list__item">
						<div class="review">
							<div class="review__body">
								@if ($review->user)
								<div class="review__avatar">
									<img src="{{ optional($review->user)->accountMenuAvatar }}" alt="@lang('Photo')">
								</div>
								@endif
								<div class="review__meta">
									<div class="review__author">
										{{ optional($review->user)->name ?? $review->name }}
									</div>
									<div class="review__date">{{ $review->created_at->toFormattedDateString() }}</div>
								</div>
								<div class="review__rating">
									<div class="rating">
										<div class="rating__body">
											@for($i = 0; $i < $review->rating; $i++)
												<div class="rating__star rating__star--active"></div>
											@endfor
											@for($s = $review->rating; $s < 5; $s++)
											<div class="rating__star"></div>
											@endfor
										</div>
									</div>
								</div>
								<div class="review__content typography">
									{{ $review->content }}
								</div>
							</div>
						</div>
					</li>
					@endforeach
					</ol>
			<div class="reviews-list__pagination">
				{{ $reviews->links() }}
			</div>
		</div>
	</div>
	<form class="reviews-view__form" action="{{ route('review.store', ['part' => $part]) }}" method="POST">
		@csrf
		<h3 class="reviews-view__header">@lang('Write A Review')</h3>
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<div class="row">
			<div class="col-xxl-8 col-xl-10 col-lg-9 col-12">
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="review-stars">@lang('Review Stars')</label>
						<select id="review-stars" class="form-control" name="rating">
							@for ($i = 5; $i >= 1; $i--)
							<option value="{{ $i }}">{{ $i . ' ' . trans_choice('Star', $i) }} </option>
							@endfor
						</select>
					</div>
					@guest
					<div class="form-group col-md-4">
						<label for="review-author">@lang('Your Name')</label>
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="review-author" placeholder="@lang('Your Name')" value="{{ old('name') }}" required autocomplete="name" autofocus>
						@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="form-group col-md-4">
						<label for="review-email">@lang('Email Address')</label>
						<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="review-email" placeholder="@lang('Email Address')" value="{{ old('email') }}" required autocomplete="email" autofocus>

						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					@endguest
				</div>
				<div class="form-group">
					<label for="review-text">@lang('Your Review')</label>
					<textarea class="form-control" name="content" id="review-text" rows="6"></textarea>
				</div>
				<div class="form-group mb-0 mt-4">
					<button type="submit" class="btn btn-primary">@lang('Post Your Review')</button>
				</div>
			</div>
		</div>
	</form>
</div>
</div>
