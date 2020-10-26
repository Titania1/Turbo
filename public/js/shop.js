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
	// Get the cars for when a vehicle is selected
	// Cars are displayed as if they are engines
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
		$.post('/api/getEnginesByCar', {
			vehicle: selectedVehicle
		}, (data) => {
			var defaultOption = $('#shop-engine').children(":first")[0].outerHTML;
			$("#shop-engine").empty();
			$('#shop-engine').append(defaultOption);
			$.each(data, (engine) => {
				var option = document.createElement('option');
				$('#shop-engine').append($(option).attr('value', data[engine].id).html(data[engine].type));
			});
			// Enable shop engine select
			$('#shop-engine').prop('disabled', false).val('none');
		})
	});
	$('#shop-car').on('change', (event) => {
		var selectedCar = $('#shop-car').find(":selected").val();
		// If user selected no car, disable all other selects
		if (selectedCar == 'none') {
			$("#shop-engine").empty();
			$("#shop-category").empty();
			$('#shop-engine').prop('disabled', true).val('none');
			$('#shop-category').prop('disabled', true).val('none');
			return;
		}
		$.post('/api/getCarsByVehicle', {
			vehicle: vehicle
		}, (data) => {
			var defaultOption = $('#shop-engine').children(":first")[0].outerHTML;
			$("#shop-engine").empty();
			$('#shop-engine').append(defaultOption);
			$.each(data, (engine) => {
				var option = document.createElement('option');
				$('#shop-engine').append($(option).attr('value', data[engine].id).html(data[engine].motor_code));
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
	$('#shop-category').on('change', (event) => {
		var selectedCategory = $('#shop-category').find(":selected").val();
		// If user selected no engine, disable all other selects
		if (selectedCategory == 'none') {
			$("#shop-part").empty();
			$('#shop-part').prop('disabled', true).val('none');
			return;
		}
		$.post('/api/getPartsByCategory', {
			category: selectedCategory
		}, (data) => {
			var defaultOption = $('#shop-part').children(":first")[0].outerHTML;
			$("#shop-part").empty();
			$('#shop-part').append(defaultOption);
			$.each(data, (part) => {
				var option = document.createElement('option');
				$('#shop-part').append($(option).attr('value', data[part].id).html(data[part].name));
			});
			// Enable shop category select
			$('#shop-part').prop('disabled', false).val('none');
		})
	});
});
