<?php
namespace lhs\tarteaucitron\bundles;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * Class SettingsAsset
 * @package lhs\tarteaucitron\bundles
 */
class SettingsAsset extends AssetBundle
{
    public function init()
    {
        $assetsFilenames = json_decode(file_get_contents(__DIR__."/../resources/webpack-assets.json"), true);

        // define the path that your publishable resources live
        $this->sourcePath = '@lhs/tarteaucitron/resources';

        // define the dependencies
        $this->depends = [
            CpAsset::class,
        ];

        // define the relative path to CSS/JS files that should be registered with the page
        // when this asset bundle is registered
        $this->js = [
            $assetsFilenames['settings']['js']
        ];

        $this->css = [
            $assetsFilenames['settings']['css'],
        ];

        parent::init();
    }
}