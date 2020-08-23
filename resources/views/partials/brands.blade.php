<div class="container">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<div class=" col-md-12 desktopbrandtabsctn">
		<fieldset>
			<legend align="center">Ou Selectionnez votre marque</legend>

			<!--Tab Buttons code for Desktop starts-->
			<div class="brandtabdesktop">
				<button class="tablink" onclick="openPage(&#39;tab1&#39;, this, &#39;#fff&#39;, &#39;#144a82&#39;)" id="defaultOpen" style="background-color: rgb(255, 255, 255); color: rgb(20, 74, 130);"><i class="fa fa-car"></i> </button>

				<button class="tablink" onclick="openPage(&#39;tab2&#39;, this, &#39;#fff&#39;, &#39;#144a82&#39;)"><i class="fa fa-truck"></i> Comercial </button>

			</div>


			<div id="tab1 " class=" tabcontent" style="display: block;">
				<div class="block block-brands block-brands--layout--columns-8-full">
					<div class="container">
						<ul class="block-brands__list">
							@foreach ($brands as $brand)

							<li class="block-brands__item">
								<a href="{{ route('brand', ['brand' => $brand]) }}" class="block-brands__item-link">
									<img src="{{ secure_asset('storage/' . $brand->logo) }}" alt="@lang('Photo')" loading="lazy" title=" <?php echo $brand->name  ?> ">
									<span class=" block-brands__item-name"> {{ $brand->name }}</span>
								</a>
							</li>
							<li class="block-brands__divider" role="presentation"></li>
							@endforeach
						</ul>
					</div>
				</div>

			</div>


			<div id="tab2" class="tabcontent" style="display: none;">
				<div class="block block-brands block-brands--layout--columns-8-full">
					<div class="container">

						<h3> tab2's conetent</h3>
					</div>
				</div>
			</div>

		</fieldset>

	</div>

	<!--Brand code for Mobile starts -->
	<div class="brandtabmobile">
		<label><span style="color:#144a82;">- OR -</span></label>
		<div class="form-group">
			<div class="col-sm-12">
				<select name="brandmobile" id="brandmobile" class="form-control">
					<option value="0">Sélectionnez ..</option>
					<option value="1"> Tourist </option>
					<option value="2"> Commercial </option>
				</select>
			</div>
		</div>




		<!--Mobile car div starts-->
		<div id="car" class="hide">
			<div class="container">
				<div class="col-12 col-xs-12 col-sm-12">


				</div>
			</div>

		</div>
		<!--Mobile car div ends-->

		<!--Mobile truck div starts-->
		<div id="truck" class="hide">
			<div class="container">
				<div class="col-12 col-xs-12 col-sm-12">
					<div class="row">
					</div>
				</div>
			</div>
		</div>


	</div>

	<!--Brand code for Mobile ends-->
</div>



<script type="text/javascript">
	/*****************Script for mobile brand dropdown starts**********************/
	jQuery(document).ready(function() {
		jQuery('#brandmobile').on('change', function() {
			if (jQuery(this).val() == 0) {
				jQuery('#car').addClass('hide');
				jQuery('#truck').addClass('hide');
			}

			if (jQuery(this).val() == 1) {
				jQuery('#car').removeClass('hide');
				jQuery('#truck').addClass('hide');
			}

			if (jQuery(this).val() == 2) {
				jQuery('#car').addClass('hide');
				jQuery('#truck').removeClass('hide');
			}

			if (jQuery(this).val() == 3) {
				jQuery('#car').addClass('hide');
				jQuery('#truck').addClass('hide');
			}
		})
	});
	/******************Script for mobile brand dropdown ends***********************/


	/***************Script for desktop tab starts*******************/
	function openPage(pageName, elmnt, bgcolor, color) {
		var i, tabcontent, tablinks, mobtab;
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablink");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].style.backgroundColor = "";
			tablinks[i].style.color = "";
		}
		mobtab = document.getElementsByClassName("mobtab");
		for (i = 0; i < mobtab.length; i++) {
			mobtab[i].style.backgroundColor = "";
			mobtab[i].style.color = "";
		}
		document.getElementById(pageName).style.display = "block";
		elmnt.style.backgroundColor = bgcolor;
		elmnt.style.color = color;
	}
	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();

	/****************Script for desktop tab ends********************/
</script>
