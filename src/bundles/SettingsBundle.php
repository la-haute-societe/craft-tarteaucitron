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
//            'libs/codemirror/hint/show-hint.js',
//            'libs/codemirror/hint/css-hint.js',
            'js/settings.js',
        ];

        $this->css = [
            'libs/codemirror/lib/codemirror.css',
//            'libs/codemirror/hint/show-hint.css',
            'css/settings.css',
        ];

        parent::init();
    }
}