<template>
	<div class="form-row">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center form-group">{{ $t("Feature") }}</th>
					<th class="text-center form-group">{{ $t("Value") }}</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="field in fields" :key="field">
					<td class="form-group">
						<input type="text" name="keys[]" :placeholder="$t('Enter Key Feature')" class="form-control" />
					</td>
					<td class="form-group">
						<input
							type="text"
							name="features[]"
							:placeholder="$t('Enter Feature Value')"
							class="form-control"
						/>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="mt-4 pt-3">
			<button class="btn btn-primary btn-sm" @click="fields++" type="button">{{ $t('Add Another') }}</button>
			<button
				type="button"
				class="btn btn-primary btn-sm"
				@click="fields--"
				v-show="fields > 1"
			>{{ $t('Remove the last') }}</button>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			fields: 1
		};
	}
};
</script>
