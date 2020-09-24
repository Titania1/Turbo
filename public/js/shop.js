/*
	.block-finder
*/
$(function() {
	// Initialize searchable select elements
	var selects = $('.form-control-select2');
		selects.select2({
			width: ''
	});
	// Catch the change event on the brand select
	$('#shop-brand').on('change', (event) => {
		var selectedBrand = $('#shop-brand').find(":selected").val();
		// If user selected no brand, disable all other selects
		if (selectedBrand == 'none') {
			$("#shop-model").empty();
			$("#shop-vehicle").empty();
			$("#shop-engine").empty();
			$("#shop-category").empty();
			$('#shop-model').prop('disabled', true).val('none');
			$('#shop-vehicle').prop('disabled', true).val('none');
			$('#shop-engine').prop('disabled', true).val('none');
			$('#shop-category').prop('disabled', true).val('none');
			return;
		}
		$.post('/api/getModelsByBrand', {
			brand: selectedBrand
		}, (data) => {
			var defaultOption = $('#shop-model').children(":first")[0].outerHTML;
			$("#shop-model").empty();
			$('#shop-model').append(defaultOption);
			$.each(data, (model) => {
				var option = document.createElement('option');
				$('#shop-model').append($(option).attr('value', data[model].id).html(data[model].name));
			});
			// Enable shop model select
			$('#shop-model').prop('disabled', false).val('none');
		})
	});
	// Catch the change event on the model select
	$('#shop-model').on('change', (event) => {
		var selectedModel = $('#shop-model').find(":selected").val();
		// If user selected no model, disable all other selects
		if (selectedModel == 'none') {
			$("#shop-vehicle").empty();
			$("#shop-engine").empty();
			$("#shop-category").empty();
			$('#shop-vehicle').prop('disabled', true).val('none');
			$('#shop-engine').prop('disabled', true).val('none');
			$('#shop-category').prop('disabled', true).val('none');
			return;
		}
		$.post('/api/getVehiclesByModel', {
			model: selectedModel
		}, (data) => {
			var defaultOption = $('#shop-vehicle').children(":first")[0].outerHTML;
			$("#shop-vehicle").empty();
			$('#shop-vehicle').append(defaultOption);
			$.each(data, (vehicle) => {
				var option = document.createElement('option');
				$('#shop-vehicle').append($(option).attr('value', data[vehicle].id).html(data[vehicle].name));
			});
			// Enable shop vehicle select
			$('#shop-vehicle').prop('disabled', false).val('none');
		})
	});
	// Catch the change event on the model select
	$('#shop-vehicle').on('change', (event) => {
		var selectedVehicle = $('#shop-vehicle').find(":selected").val();
		// If user selected no vehicle, disable all other selects
		if (selectedVehicle == 'none') {
			$("#shop-engine").empty();
			$("#shop-category").empty();
			$('#shop-engine').prop('disabled', true).val('none');
			$('#shop-category').prop('disabled', true).val('none');
			return;
		}
		$.post('/api/getEnginesByVehicle', {
			vehicle: selectedVehicle
		}, (data) => {
			var defaultOption = $('#shop-engine').children(":first")[0].outerHTML;
			$("#shop-engine").empty();
			$('#shop-engine').append(defaultOption);
			$.each(data, (engine) => {
				var option = document.createElement('option');
				$('#shop-engine').append($(option).attr('value', data[engine].id).html(data[engine].type + data[engine].motor_code));
			});
			// Enable shop engine select
			$('#shop-engine').prop('disabled', false).val('none');
		})
	});
	// Catch the change event on the model select
	$('#shop-engine').on('change', (event) => {
		var selectedEngine = $('#shop-engine').find(":selected").val();
		// If user selected no engine, disable all other selects
		if (selectedEngine == 'none') {
			$("#shop-category").empty();
			$('#shop-category').prop('disabled', true).val('none');
			return;
		}
		$.post('/api/getCategoriesByEngine', {
			engine: selectedEngine
		}, (data) => {
			var defaultOption = $('#shop-category').children(":first")[0].outerHTML;
			$("#shop-category").empty();
			$('#shop-category').append(defaultOption);
			$.each(data, (category) => {
				var option = document.createElement('option');
				$('#shop-category').append($(option).attr('value', data[category].id).html(data[category].name));
			});
			// Enable shop category select
			$('#shop-category').prop('disabled', false).val('none');
		})
	});
	// $('#shop-fuel').on('change', (event) => {
	// 	$('#submit-search').prop('disabled', false);
	// });
});
