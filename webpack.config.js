/**
 * webpack.config.js
 *
 * @author Philippe Gaultier <pgaultier@sweelix.net>
 * @copyright 2010-2017 Philippe Gaultier
 * @license http://www.ibitux.com/license license
 * @version XXX
 * @link http://www.ibitux.com
 */

const webpack = require('webpack');
const path = require('path');
const fs = require('fs');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const ExtraneousFileCleanupPlugin = require('webpack-extraneous-file-cleanup-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const WriteFilePlugin = require('write-file-webpack-plugin');

var confPath = './webpack-craft.json';
if (!fs.existsSync(confPath)) {
  throw 'Error: file "' + confPath + '" not found.';
}

var config = require(confPath);

module.exports = {
  entry: config.entry,
  context: path.resolve(__dirname, config.sourceDir, config.subDirectories.sources),
  output: {
    path: path.resolve(__dirname, config.sourceDir, config.subDirectories.dist, config.assets.scripts),
    filename: '[name].js'
  },
  plugins: [
    new CleanWebpackPlugin([config.subDirectories.dist], {
      root: path.resolve(__dirname, config.sourceDir),
      verbose: true,
      dry: false,
      exclude: []
    }),
    // new webpack.optimize.CommonsChunkPlugin({
    //   names: config.commonBundles
    // }),
    new ExtractTextPlugin({
      filename:  (getPath) => {
        return getPath('../css/[name].css').replace('css/js', 'css');
      },
    }),
    new HtmlWebpackPlugin({
      filename: '../generated-assets-files.json',
      template: 'underscore-template-loader!'+path.resolve(__dirname, config.sourceDir)+'/assets-files.json.tpl',
      inject: false,
      chunksSortMode: 'dependency'
    }),
    new WriteFilePlugin({
      test:  /generated-assets-files\.json$/,
      force: true,
      log: false
    }),
    // new ExtraneousFileCleanupPlugin({
    //   extensions: ['.js', '.css'],
    //   minBytes: 512,
    //   manifestJsonName: 'generated-assets-files.json'
    // }),
  ],
  externals: config.externals,
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules)/,
        use: {
          loader: "babel-loader",
          options: {
            presets: ["babel-preset-env"]
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
