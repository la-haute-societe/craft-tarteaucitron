<?php
namespace lhs\tarteaucitron\bundles;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * Class FrontAsset
 * @package lhs\tarteaucitron\bundles
 */
class FrontAsset extends AssetBundle
{
    public function init()
    {
        // define the path that your publishable resources live
        $this->sourcePath = '@lhs/tarteaucitron/resources/tarteaucitron';

        // define the relative path to CSS/JS files that should be registered with the page
        // when this asset bundle is registered
        $this->js = [
            'tarteaucitron.js',
        ];

        $this->css = [
            'css/tarteaucitron.css'
        ];

        parent::init();
    }
}
