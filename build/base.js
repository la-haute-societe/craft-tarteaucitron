/**
 * webpack.config.js
 */

const webpack = require('webpack');
const path = require('path');

const CleanWebpackPlugin = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const AssetsPlugin = require('assets-webpack-plugin');


// Webpack process
module.exports = (config) => {
    return {
        entry: config.entry,
        context: path.resolve(__dirname, config.sourceDir),
        output: {
            path: path.resolve(__dirname, config.outputDir),
            filename: `${config.assets.scripts}/${config.filenames[process.env.NODE_ENV].js}`
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
                    `${path.resolve(__dirname, config.outputDir)}/**/*`
                ],
                {
                    root: path.resolve(__dirname, '../'),
                    verbose: true,
                    dry: false,
                    exclude: []
                }
            ),

            // Extract css to new files
            new MiniCssExtractPlugin({
                filename: `${config.assets.styles}/${config.filenames[process.env.NODE_ENV].css}`,
                chunkFilename: `${config.assets.styles}/${config.filenames[process.env.NODE_ENV].cssChunk}`,
            }),
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
                    test: /\.(sa|sc|c)ss$/,
                    use: [
                        MiniCssExtractPlugin.loader,
                        'css-loader',
                        // 'postcss-loader',
                        'sass-loader',
                    ],
                },
            ]
        },
        devtool: 'source-map',
        target: 'web'
    }
};
