<!-- site__footer -->
<footer class="site__footer">
	<div class="site-footer">
		<div class="decor site-footer__decor decor--type--bottom">
			<div class="decor__body">
				<div class="decor__start"></div>
				<div class="decor__end"></div>
				<div class="decor__center"></div>
			</div>
		</div>
		<div class="site-footer__widgets">
			<div class="container">
				<div class="row">
					<div class="col-12 col-xl-4">
						<div class="site-footer__widget footer-contacts">
							<h5 class="footer-contacts__title">@lang('Contact US')</h5>
							<div class="footer-contacts__text">
								Lorem ipsum dolor sit amet, consectetur
								adipiscing elit. Integer in feugiat lorem.
							</div>
							<address class="footer-contacts__contacts">
								<dl>
									<dt>@lang('Phone number')</dt>
									<dd>
										<a href="tel:@option('header.phone')">
											@option('header.phone')
										</a>
									</dd>
								</dl>
								<dl>
									<dt>@lang('Email Address')</dt>
									<dd>
										<a href="mailto:@option('footer.email')">
											@option('footer.email')
										</a>
									</dd>
								</dl>
								<dl>
									<dt>@lang('Our Location')</dt>
									{{-- Should also be a link to Google Maps --}}
									<dd>
										@option('footer.address')
									</dd>
								</dl>
								<dl>
									<dt>@lang('Working Hours')</dt>
									<dd>
										@option('footer.schedule')
									</dd>
								</dl>
							</address>
						</div>
					</div>
					<div class="col-6 col-md-3 col-xl-2">
						<div class="site-footer__widget footer-links">
							<h5 class="footer-links__title">@lang('Information')</h5>
							<ul class="footer-links__list">
								<li class="footer-links__item">
									<a href="/about" class="footer-links__link">
										@lang('About')
									</a>
								</li>
								<li class="footer-links__item">
									<a href="#" class="footer-links__link">
										@lang('Delivery Information')
									</a>
								</li>
								<li class="footer-links__item">
									<a href="/terms" class="footer-links__link">
										@lang('Terms And Conditions')
									</a>
								</li>
								<li class="footer-links__item">
									<a href="/contact" class="footer-links__link">
										@lang('Contact US')
									</a>
								</li>
								<li class="footer-links__item">
									<a href="/faq" class="footer-links__link">
										@lang('Frequently Asked Questions')
									</a>
								</li>
								<li class="footer-links__item">
									<a href="#" class="footer-links__link">
										@lang('Site Map')
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-6 col-md-3 col-xl-2">
						<div class="site-footer__widget footer-links">
							<h5 class="footer-links__title">@lang('My Account')</h5>
							<ul class="footer-links__list">
								<li class="footer-links__item">
									<a href="#" class="footer-links__link">
										@lang('Store Location')
									</a>
								</li>
								<li class="footer-links__item">
									<a href="/account-orders" class="footer-links__link">
										@lang('Order History')
									</a>
								</li>
								<li class="footer-links__item">
									<a href="/wishlist" class="footer-links__link">
										@lang('Wish List')
									</a>
								</li>
								<li class="footer-links__item">
									<a href="#" class="footer-links__link">
										@lang('Newsletter')
									</a>
								</li>
								<li class="footer-links__item">
									<a href="#" class="footer-links__link">
										@lang('Specials')
									</a>
								</li>
								<li class="footer-links__item">
									<a href="#" class="footer-links__link">
										@lang('Gift Certificates')
									</a>
								</li>
						</div>
					</div>
					<div class="col-12 col-md-6 col-xl-4">
						<div class="site-footer__widget footer-newsletter">
							<h5 class="footer-newsletter__title">@lang('Newsletter')</h5>
							<div class="footer-newsletter__text">
								@lang('footer.subscribe')
							</div>
							@if (\Session::has('success'))
							<div class="alert alert-success" role="alert">
								{{ \Session::get('success') }}
							</div>
							@endif
							@if (\Session::has('failure'))
							<div class="alert alert-danger" role="alert">
								<p>{{ \Session::get('failure') }}</p>
							</div>
							@endif
							<form action="{{url('/newsletter')}}" class="footer-newsletter__form" method="post">
								{{csrf_field()}}
								<label class="sr-only" for="footer-newsletter-address">
									@lang('Email Address')
								</label>
								<input type="text" class="footer-newsletter__form-input" name="email" id="footer-newsletter-address" placeholder="@lang('Email Address')">
								<button class="footer-newsletter__form-button" y>@lang('Subscribe')</button>
							</form>

							<!--  end   -->

							<div class="footer-newsletter__text footer-newsletter__text--social">
								@lang('Follow us on social networks')
							</div>
							<div class="footer-newsletter__social-links social-links">
								<ul class="social-links__list">
									<li class="social-links__item social-links__item--facebook">
										<a href="@option('footer.facebook')" target="_blank">
											<i class="fab fa-facebook-f"></i>
										</a>
									</li>
									<li class="social-links__item social-links__item--twitter">
										<a href="@option('footer.twitter')" target="_blank">
											<i class="fab fa-twitter"></i>
										</a>
									</li>
									<li class="social-links__item social-links__item--youtube">
										<a href="@option('footer.youtube')" target="_blank">
											<i class="fab fa-youtube"></i>
										</a>
									</li>
									<li class="social-links__item social-links__item--instagram">
										<a href="@option('footer.instagram')" target="_blank">
											<i class="fab fa-instagram"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="site-footer__bottom">
			<div class="container">
				<div class="site-footer__bottom">
					<div class="container">
						<div class="site-footer__bottom-row">
							<div class="site-footer__copyright">
								<!-- copyright -->
								@lang('All Rights Reserved') © {{ date('Y') }}
								- @lang('Designed by') <a href="https://sitando.com" target="_blank">Sitando</a>
								<!-- copyright / end -->
							</div>
							<div class="site-footer__payments">
								<img src="/images/payments.png" alt="@lang('Payment')">
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</footer>
<!-- site__footer / end -->
