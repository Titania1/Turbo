/*
	.block-finder
*/
$(function() {
	$('#select-year').on('change', (event) => {
		var selectedYear = $('#select-year').find(":selected").text();
		$.post('/api/getYearBrands', {
			year: selectedYear
		}, (data) => {
			// When we empty the model, the default selected option is gone
			// Let's get that option and hold it in a variable
			var defaultOption = $('#select-brand').children(":first")[0].outerHTML;
			// Empty the select
			$("#select-brand").empty();
			// Create default option
			$('#select-brand').append(defaultOption);
			$.each(data, (brand) => {
				var option = document.createElement('option');
				$('#select-brand').append($(option).attr('value', data[brand].id).html(data[brand].name));
			});
			$('#select-brand').prop('disabled', false).val('none');
		})
	});
	$('#select-brand').on('change', (event) => {
		var selectedBrand = $('#select-brand').find(":selected").val();
		$.post('/api/getVehicleModelsByBrand', {
			brand: selectedBrand
		}, (data) => {
			var defaultOption = $('#select-model').children(":first")[0].outerHTML;
			$("#select-model").empty();
			$('#select-model').append(defaultOption);
			$.each(data, (model) => {
				var option = document.createElement('option');
				$('#select-model').append($(option).attr('value', data[model]).html(data[model]));
			});
			$('#select-model').prop('disabled', false).val('none');
		})
	});
	$('#select-model').on('change', (event) => {
		var selectedModel = $('#select-model').find(":selected").text();
		$.post('/api/getFuelOptionsForModel', {
			model: selectedModel
		}, (data) => {
			var defaultOption = $('#select-fuel').children(":first")[0].outerHTML;
			$("#select-fuel").empty();
			$('#select-fuel').append(defaultOption);
			$.each(data, (fuel) => {
				var option = document.createElement('option');
				$('#select-fuel').append($(option).attr('value', data[fuel]).html(data[fuel]));
			});
			$('#select-fuel').prop('disabled', false).val('none');
		})
	});
	$('#select-fuel').on('change', (event) => {
		$('#submit-search').prop('disabled', false);
	});
});
