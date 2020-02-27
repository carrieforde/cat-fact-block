const path = require("path");

module.exports = {
	context: __dirname,
	entry: {
		block: ["cat-fact-component", "./index.js"],
		component: "cat-fact-component"
	},
	output: {
		path: path.resolve(__dirname, "dist"),
		filename: "cat-fact-[name].js"
	},
	mode: "development",
	module: {
		rules: [
			{
				test: /\.jsx?$/,
				loader: "babel-loader"
			}
		]
	}
};
