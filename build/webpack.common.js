/**
 * webpack.config.js
 */

const webpack = require('webpack');
const path = require('path');
const fs = require('fs');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const AssetsPlugin = require('assets-webpack-plugin');

// Get config
const confPath = path.join(__dirname, 'webpack.config.json');
if (!fs.existsSync(confPath)) {
    throw 'Error: file "' + confPath + '" not found.';
}
const config = require(confPath);


module.exports = {
    entry: config.entry,
    context: path.resolve(__dirname, config.sourceDir),
    output: {
        path: path.resolve(__dirname, config.outputDir),
        filename: config.assets.scripts.concat('/[name].js')
    },
    plugins: [

        // Write path to all generated assets in json file
        new AssetsPlugin(
            {
                path: path.resolve(__dirname, config.outputDir),
                prettyPrint: true,
                entrypoints: true,
                useCompilerPath: true
            }
        ),

        // Clean resources folder
        new CleanWebpackPlugin(
            [
                path.resolve(__dirname, config.outputDir).concat('/**/*')
            ], {
                verbose: true,
                dry: false,
                exclude: []
            }),

        // Extract css to new files
        new ExtractTextPlugin({
            filename: (getPath) => {
                return getPath(config.assets.styles.concat('/[name].css')).replace('css/js', 'css');
            },
        }),

        // new ExtraneousFileCleanupPlugin({
        //   extensions: ['.js', '.css'],
        //   minBytes: 512,
        //   manifestJsonName: 'generated-assets-files.json'
        // }),
    ],

    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules)/,
                use: {
                    loader: "babel-loader",
                    options: {
                        presets: ["@babel/preset-env"]
                    }
                }
            },
            {
                test: /\.s[ac]ss$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: ['css-loader', 'sass-loader']
                })
            },
            {
                test: /\.css$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: ['css-loader']
                })
            }
        ]
    },
    devtool: 'source-map',
    target: 'web'
};
