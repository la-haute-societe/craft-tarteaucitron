<?php
namespace lahautesociete\tarteaucitron\bundles;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class SettingsBundle extends AssetBundle
{
    public function init()
    {
        // define the path that your publishable resources live
        $this->sourcePath = '@lahautesociete/tarteaucitron/resources';

        // define the dependencies
        $this->depends = [
            CpAsset::class,
        ];

        // define the relative path to CSS/JS files that should be registered with the page
        // when this asset bundle is registered
        $this->js = [
            'libs/codemirror/lib/codemirror.js',
            'libs/codemirror/addon/edit/closebrackets.js',
            'libs/codemirror/mode/css/css.js',
            'libs/codemirror/mode/javascript/javascript.js',
            'webpack/dist/js/settings.js',
        ];

        $this->css = [
            'libs/codemirror/lib/codemirror.css',
            'webpack/dist/css/settings.css',
        ];

        parent::init();
    }
}