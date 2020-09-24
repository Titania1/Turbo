<div class="header__navbar-departments">
	<div class="departments">
		<button class="departments__button" type="button">
			<span class="departments__button-icon">
				@include('svg.sidebar')
			</span>
			<span class="departments__button-title">
				@lang('Menu')
			</span>
			<span class="departments__button-arrow">
				@include('svg.button_arrow')
			</span>
		</button>
		<div class="departments__menu">
			<div class="departments__arrow"></div>
			<div class="departments__body">
				<ul class="departments__list">
					<li class="departments__list-padding" role="presentation"></li>
					@foreach ($categories as $category)
					<li class="departments__item departments__item--submenu--megamenu departments__item--has-submenu">
						<a href="{{ route('category', ['category' => $category]) }}" class="departments__item-link">
							{{ $category->name }}
							<span class="departments__item-arrow">
								@include('svg.arrow_right')
							</span>
						</a>
						<div class="departments__item-menu">
							<div class="megamenu departments__megamenu departments__megamenu--size--{{ $category->megaMenuSize }}">
								<div class="megamenu__image" style="background-image: url('{{ secure_asset('storage/'.$category->image) }}')">
								</div>
								<div class="row">
									@foreach ($category->fertileSubCategories as $sub_category)
									<div class="col-1of{{ round($category->fertileSubCategories->count() / 2) }}">
										<ul class="megamenu__links megamenu-links megamenu-links--root">
											<li class="megamenu-links__item megamenu-links__item--has-submenu">
												<a class="megamenu-links__item-link" href="{{ route('category', ['category' => $sub_category]) }}">
													{{ $sub_category->name }}
												</a>
												<ul class="megamenu-links">
													@foreach ($sub_category->types as $type)
													<li class="megamenu-links__item">
														<a class="megamenu-links__item-link" href="{{ route('type', ['type' => $type]) }}">
															{{ $type->name }}
														</a>
													</li>
													@endforeach
												</ul>
											</li>
										</ul>
									</div>
									@endforeach
									@foreach ($category->infertileSubCategories->chunk(5) as $chunk)
									<div class="col-1of3">
										<ul class="megamenu__links megamenu-links megamenu-links--root">
											@foreach ($chunk as $sub_category)
											<li class="megamenu-links__item">
												<a class="megamenu-links__item-link" href="{{ route('category', ['category' => $category]) }}">
													{{ $sub_category->name }}
												</a>
											</li>
											@endforeach
										</ul>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</li>
					@endforeach
					@foreach ($infertile_categories as $category)
					<li class="departments__item">
						<a href="{{ route('category', ['category' => $category]) }}" class="departments__item-link">
							{{ $category->name }}
						</a>
					</li>
					@endforeach
					<li class="departments__list-padding" role="presentation"></li>
				</ul>
				<div class="departments__menu-container"></div>
			</div>
		</div>

	</div>
</div>
