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
    /**
     * Just publish the asset bundle but do not auto inject assets in the page
     */
    public function init()
    {
        $this->sourcePath = '@lhs/tarteaucitron/resources/tarteaucitron';

        parent::init();
    }
}
