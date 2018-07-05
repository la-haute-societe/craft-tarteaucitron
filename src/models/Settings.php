<?php

namespace lahautesociete\tarteaucitron\models;

use craft\base\Model;

/**
 * Class Settings
 * @package lahautesociete\tarteaucitron\models
 */

class Settings extends Model
{
    /**
     * @var string
     */
    public $hashtag = '#tarteaucitron';

    /**
     * @var bool
     */
    public $highPrivacy = false;

    /**
     * @var string
     */
    public $orientation = "top";

    /**
     * @var bool
     */
    public $adblocker = false;

    /**
     * @var bool
     */
    public $showAlertSmall = true;

    /**
     * @var bool
     */
    public $cookieslist = true;

    /**
     * @var bool
     */
    public $removeCredit = false;

    /**
     * @var bool
     */
    public $handleBrowserDNTRequest = false;

    /**
     * @var string
     */
    public $cookieDomain = '';

    /**
     * @var string
     */
    public $customCss = '';

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['hashtag', 'orientation', 'cookieDomain', 'customCss'], 'string'],
            [['highPrivacy', 'adblocker', 'showAlertSmall', 'cookieslist', 'removeCredit', 'handleBrowserDNTRequest'], 'boolean'],
            ['hashtag', 'default', 'value' => '#tarteaucitron'],
            ['highPrivacy', 'default', 'value' => false],
            ['orientation', 'default', 'value' => 'top'],
            ['adblocker', 'default', 'value' => false],
            ['showAlertSmall', 'default', 'value' => true],
            ['cookieslist', 'default', 'value' => true],
            ['removeCredit', 'default', 'value' => false],
            ['handleBrowserDNTRequest', 'default', 'value' => false],
            ['cookieDomain', 'default', 'value' => null],
            ['customCss', 'default', 'value' => ""],
        ];
    }
}
