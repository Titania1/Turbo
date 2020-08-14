<template>
	<form class="search__body">
		<div class="search__shadow"></div>
		<input
			v-model="query"
			class="search__input"
			type="text"
			:placeholder="$t('Enter Keyword or Part Number')"
		/>
		<div class="search__button search__button--start">
			<span class="search__button-icon">
				<svg-magnifier></svg-magnifier>
			</span>
		</div>
		<div class="search__box"></div>
		<div class="search__decor">
			<div class="search__decor-start"></div>
			<div class="search__decor-end"></div>
		</div>
		<div class="search__dropdown search__dropdown--suggestions suggestions">
			<div class="suggestions__group">
				<ais-instant-search :search-client="algoliaClient" index-name="parts_index">
					<ais-configure :query="query" :hitsPerPage="4"></ais-configure>
					<div class="suggestions__group-title">{{ $t('Products') }}</div>
					<ais-hits :class-names="{'ais-Hits': 'suggestions__group-content'}">
						<div class="suggestions__group-content" slot-scope="{items}">
							<a
								v-for="item in items"
								:key="item.objectID"
								class="suggestions__item suggestions__product"
								:href="`/part/${item.slug}`"
							>
								<div class="suggestions__product-image">
									<img :src="`/storage/${item.image}`" :alt="$t('photo')" width="40" height="40" />
								</div>
								<div class="suggestions__product-info">
									<ais-highlight
										:class-names="{'ais-Highlight': 'suggestions__product-name'}"
										attribute="title"
										:hit="item"
									/>
									<div class="suggestions__product-rating">
										<div class="suggestions__product-rating-stars">
											<div class="rating">
												<div class="rating__body">
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
												</div>
											</div>
										</div>
										<div class="suggestions__product-rating-label">5 on 22 reviews</div>
									</div>
								</div>
								<div class="suggestions__product-price">{{ item.price }} DZD</div>
							</a>
						</div>
					</ais-hits>
				</ais-instant-search>
			</div>
			<div class="suggestions__group">
				<div class="suggestions__group-title">{{ $t('Categories')}}</div>
				<div class="suggestions__group-content">
					<a class="suggestions__item suggestions__category" href="#">Headlights & Lighting</a>
				</div>
			</div>
			<div id="powered-by" style="float: right;padding-right: 10px;"></div>
		</div>
	</form>
</template>

<script>
import {
	AisInstantSearch,
	AisHits,
	AisConfigure,
	AisHighlight
} from "vue-instantsearch";
import algoliasearch from "algoliasearch/lite";

// Build up an Algolia Client
const algoliaClient = algoliasearch(
	"3W1YKTWP94",
	"df1b7898727e456a094ccac34d855246"
);

export default {
	// Tree shaking to optimize the build
	components: {
		AisInstantSearch,
		AisHits,
		AisConfigure,
		AisHighlight
	},
	data() {
		return {
			algoliaClient,
			query: ""
		};
	},
	methods: {
		sluggify(title) {
			title = title.trim().toLowerCase();
		}
	}
};
</script>
