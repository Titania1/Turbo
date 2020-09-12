<template>
	<div class="product__actions">
		<div class="product__actions-item product__actions-item--quantity">
			<input
				class="input-number__input form-control form-control-lg"
				id="quantity"
				type="number"
				min="1"
				v-model="quantity"
			/>
			<div class="input-number__add" @click="quantity++"></div>
			<div class="input-number__sub" @click="quantity--"></div>

			<form action="{{ route('cart.add', ['part' => $part]) }}" method="post">
				<div
					class="product__actions product__actions-item product__actions-item--addtocart product__actions-item--quantity"
				>
					<button class="btn btn-primary btn-lg btn-block" @click="addtocart">{{ $t('Add to cart') }}</button>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
import axios from "axios";
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
					swal(this.$i18n.t("Success"), "Item quantity updated");
				})
				.catch((errors) => {
					console.log(errors.response.data);
				});
		},
	},
	mounted() {
		axios
			.get(`/cart/${this.part.id}/quantity`)
			.then((response) => (this.quantity = response.data))
			.catch((error) => swal("error", error.response.data));
	},
};
</script>
