<div class="rating">
	<div class="rating__body">
		@for($i = 0; $i < $item->rating; $i++)
			<div class="rating__star rating__star--active"></div>
		@endfor
		@for($s = $item->rating; $s < 5; $s++)
			<div class="rating__star"></div>
		@endfor
	</div>
</div>
