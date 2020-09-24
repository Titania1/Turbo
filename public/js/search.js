/* global instantsearch algoliasearch */

const search = instantsearch({
	indexName: 'parts_index',
	searchClient: algoliasearch('3W1YKTWP94', 'df1b7898727e456a094ccac34d855246'),
});

search.addWidgets([
	instantsearch.widgets.clearRefinements({
		container: '.applied-filters__button--clear',
	}),
	instantsearch.widgets.refinementList({
		container: '.filter-categories__list',
		attribute: 'brand',
	}),
	instantsearch.widgets.hits({
		container: '#hits',
		templates: {
			item: `
		<div>
		  <img src="{{image}}" align="left" alt="{{name}}" />
		  <div class="hit-name">
			{{#helpers.highlight}}{ "attribute": "title" }{{/helpers.highlight}}
		  </div>
		  <div class="hit-description">
			{{#helpers.highlight}}{ "attribute": "description" }{{/helpers.highlight}}
		  </div>
		  <div class="hit-price">\${{price}}</div>
		</div>
	  `,
		},
	}),
	instantsearch.widgets.pagination({
		container: '#pagination',
	}),
]);

search.start();
