<template>
<div>
	<div class="product__actions">
		<div class="product__actions-item product__actions-item--quantity ">
			<input
				class="input-number__input form-control form-control-lg "
				id="quantity"
				type="number"
				min="1"
				v-model="quantity"
			/>
			<div class="input-number__add" @click="quantity++"></div>
			<div class="input-number__sub" @click="quantity--"></div>
			<div
				class="product__action-item product__actions-item--addtocart  "
			>
				<button class="btn btn-primary btn-lg btn-block" @click="addtocart">{{ $t(' Update quantity') }}</button>
			</div>
		</div>
	</div>


</div>
</template>

<script>
import swal from "sweetalert";

export default {
	props: {
		part: {
			type: Object,
			required: true,
		},
	},
	data() {
		return {
			quantity: 1,
		};
	},
	methods: {
		addtocart() {
			axios
				.post(`/cart/add/${this.part.slug}`, {
					quantity: this.quantity,
				})
				.then((response) => {
					swal(this.$i18n.t("Success"), "Item quantity updated", "success");
				})
				.catch((errors) => {
					swal(this.$i18n.t("error"), errors.response.data, "error");
				
				});
		}
	},
	mounted() {
		axios
			.get(`/cart/${this.part.id}/quantity`)
			.then((response) => (this.quantity = response.data))
			.catch((error) => swal("error", error.response.data));
	},
};
</script>

