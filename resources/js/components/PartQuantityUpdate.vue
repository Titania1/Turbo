<template>
	<fragment>
		<div class="product__actions-item product__actions-item--quantity">
			<div class="input-number">
				<input
					class="input-number__input form-control form-control-lg"
					id="quantity"
					type="number"
					min="1"
					v-model="quantity"
				/>
				<div class="input-number__add" @click="quantity++"></div>
				<div class="input-number__sub" @click="quantity--"></div>
			</div>
		</div>
		<div class="product__action-item product__actions-item--addtocart">
			<button class="btn btn-primary btn-lg btn-block" @click="addtocart">{{ $t(buttonText) }}</button>
		</div>
	</fragment>
</template>

<script>
import swal from "sweetalert";

export default {
	props: {
		part: {
			type: Object,
			required: true
		}
	},
	data() {
		return {
			quantity: 1,
			initial: 0
		};
	},
	computed: {
		buttonText() {
			return this.quantity > 1 ? "Update quantity" : "Add to cart";
		}
	},
	methods: {
		addtocart() {
			axios
				.post(`/cart/add/${this.part.slug}`, {
					quantity: this.quantity - this.initial
				})
				.then(response => {
					swal(
						this.$i18n.t("Success"),
						response.data.message,
						"success"
					);
				})
				.catch(error => {
					swal(this.$i18n.t("error"), error.response.data, "error");
				});
		}
	},
	mounted() {
		axios
			.get(`/cart/${this.part.id}/quantity`)
			.then(response => {
				if (response.data) {
					this.quantity = response.data;
					this.initial = response.data;
				}
			})
			.catch(error =>
				swal(this.$i18n.t("error"), error.response.data, "error")
			);
	}
};
</script>

<style>
.product__actions-item--quantity {
	width: 100px;
	margin-right: 8px;
}
.product__actions-item--addtocart .btn {
	padding: 10px 10px;
}
</style>
