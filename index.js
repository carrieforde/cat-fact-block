const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;

import "cat-fact-component";

registerBlockType("cat-fact-block/cat-fact-block", {
	title: __("Cat Fact", "cat-fact-block"),
	category: "widgets",
	supports: {
		html: false
	},
	edit: () => <cat-fact></cat-fact>,
	save: () => <cat-fact></cat-fact>
});
