<template>
	<div class="topbar__menu" :class="{ 'topbar__menu--open': open }">
		<button
			class="topbar__button topbar__button--has-arrow topbar__menu-button"
			type="button"
			@click="toggle"
		>
			<span class="topbar__button-label">{{ $t("Language:") }}</span>
			<span class="topbar__button-title">{{ locale }}</span>
			<span class="topbar__button-arrow">
				<svg-arrow-down></svg-arrow-down>
			</span>
		</button>
		<div class="topbar__menu-body" @mouseleave="toggle">
			<a
				class="topbar__menu-item"
				v-for="locale in locales"
				:key="locale"
				:href="`/lang/${locale}`"
			>
				<img
					:src="`/images/languages/${locale}.png`"
					:alt="$t('Flag')"
				/>
				<span>{{ $t(locale) }}</span>
			</a>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			locale: this.$i18n.locale.toUpperCase(),
			locales: ["fr", "en", "ar"],
			open: false
		};
	},
	methods: {
		toggle() {
			this.open = !this.open;
		}
	}
};
</script>
