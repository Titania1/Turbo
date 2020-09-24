@if ($paginator->hasPages())
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link page-link--with-arrow" aria-hidden="true">
						<span class="page-link__arrow page-link__arrow--left" aria-hidden="true">
							@include('svg.arrow_left')
						</span>
					</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link page-link--with-arrow" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
						<span class="page-link__arrow page-link__arrow--left" aria-hidden="true">
							@include('svg.arrow_left')
						</span>
					</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
					<li class="page-item page-item--dots">
						<div class="pagination__dots"></div>
					</li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
								<span class="page-link ">
									{{ $page }} <span class="sr-only">(current)</span>
								</span>
							</li>
                        @else
                            <li class="page-item"><a class="page-link " href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link page-link--with-arrow " href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
						<span class="page-link__arrow page-link__arrow--right" aria-hidden="true">
							@include('svg.arrow_right')
						</span>
					</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link page-link--with-arrow" aria-hidden="true">
						<span class="page-link__arrow page-link__arrow--right" aria-hidden="true">
							@include('svg.arrow_right')
						</span>
					</span>
                </li>
            @endif
        </ul>
@endif
