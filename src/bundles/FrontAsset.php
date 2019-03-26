<?php
namespace lahautesociete\tarteaucitron\bundles;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * Class FrontAsset
 * @package lahautesociete\tarteaucitron\bundles
 */
class FrontAsset extends AssetBundle
{
    public function init()
    {
        $assetsFilenames = json_decode(file_get_contents(__DIR__."/../resources/webpack-assets.json"), true);

        // define the path that your publishable resources live
        $this->sourcePath = '@lahautesociete/tarteaucitron/resources';

        // define the dependencies
        $this->depends = [
            CpAsset::class,
        ];

        // define the relative path to CSS/JS files that should be registered with the page
        // when this asset bundle is registered
        $this->js = [
            $assetsFilenames['tarteaucitron']['js']
        ];

        $this->css = [
            $assetsFilenames['tarteaucitron']['css'],
        ];

        parent::init();
    }
}