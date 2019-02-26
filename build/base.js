/**
 * webpack.config.js
 */

const webpack = require('webpack');
const path = require('path');

const CleanWebpackPlugin = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const AssetsPlugin = require('assets-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');


// Get list of files paths to copy
function getCopyFilesPathsArray(paths, baseOutputDir) {
    let copyFilesArray = [];

    for (let copyFilePaths of paths) {
        copyFilesArray.push({
            "from": copyFilePaths["from"],
            "to": path.resolve(__dirname, baseOutputDir, copyFilePaths["to"]),
            "flatten": true
        });
    }
    return copyFilesArray;

}

// Webpack process
module.exports = (config) => {
    let copyFilesArray = getCopyFilesPathsArray(config.assets.copy, config.outputDir);

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

            // Copy files
            new CopyPlugin(copyFilesArray),

            // Extract css to new files
            new MiniCssExtractPlugin({
                filename: `${config.assets.styles}/${config.filenames[process.env.NODE_ENV].css}`,
                chunkFilename: `${config.assets.styles}/${config.filenames[process.env.NODE_ENV].cssChunk}`,
            }),
        ],

        module: {
            rules: [
                {
                    test: /\.(png|jpe?g|gif)(\?\S*)?$/,
                    use: {
                        loader: 'file-loader',
                        options: {
                            outputPath: 'assets/img/',
                            publicPath: '../assets/img/',
                            name: '[name].[ext]'
                        }
                    },
                },
                {
                    test: /\.(svg|woff|woff2|ttf|eot|otf)(\?\S*)?$/,
                    use: {
                        loader: 'file-loader',
                        options: {
                            outputPath: 'assets/fonts/',
                            publicPath: '../assets/fonts/',
                            name: '[name].[ext]'
                        }
                    },
                },
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
                        'sass-loader',
                    ],
                },
            ]
        },
        devtool: 'source-map',
        target: 'web'
    }
};


