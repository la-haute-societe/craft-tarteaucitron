const webpack = require('webpack');
const path = require('path');
const fs = require('fs');

const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');


// Get config
const confPath = path.join(__dirname, 'config.json');
if (!fs.existsSync(confPath)) {
    throw 'Error: file "' + confPath + '" not found.';
}
const config = require(confPath);


module.exports = () => {

    // Get Webpack base config
    const webpackConfig = require('./base')(config);
    webpackConfig.mode = "production";


    // Set optimization
    webpackConfig.optimization = {
        minimizer: [
            new UglifyJsPlugin(),
            new OptimizeCSSAssetsPlugin({})
        ]
    };

    return webpackConfig;
};
