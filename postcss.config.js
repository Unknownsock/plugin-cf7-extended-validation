module.exports = {
	plugins: [
		require('postcss-preset-env')({
			stage: 3
		}),
		require('autoprefixer'),
		require('cssnano')({
			preset: ['default', {
				discardComments: {
					removeAll: true,
				},
			}]
		})
	],
};
