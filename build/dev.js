const webpack = require('webpack');
const path = require('path');
const fs = require('fs');


// Get config
const confPath = path.join(__dirname, 'config.json');
if (!fs.existsSync(confPath)) {
    throw 'Error: file "' + confPath + '" not found.';
}
const config = require(confPath);


module.exports = () => {

    // Get Webpack base config
    const webpackConfig = require('./base')(config);
    webpackConfig.mode = "development";

    return webpackConfig;
};
