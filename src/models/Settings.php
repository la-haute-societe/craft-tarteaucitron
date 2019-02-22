<?php

namespace lahautesociete\tarteaucitron\models;

use Craft;
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
     * @var boolean
     */
    public $isGoogleTagManagerEnabled = false;

    /**
     * @var string
     */
    public $googleTagManagerId = '';

    /**
     * @var boolean
     */
    public $isReCAPTCHAEnabled = false;

    /**
     * @var string
     */
    public $reCAPTCHASiteKey = '';

    /**
     * @var boolean
     */
    public $isGoogleMapsEnabled = false;

    /**
     * @var string
     */
    public $googleMapsAPIKey = '';

    /**
     * @var boolean
     */
    public $isGoogleAnalyticsUniversalEnabled = false;

    /**
     * @var string
     */
    public $googleAnalyticsUniversalUa = '';

    /**
     * @var string
     */
    public $googleAnalyticsUniversalMore = '';

    /**
     * @var boolean
     */
    public $isGoogleAdwordsConversionEnabled = false;

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            // Service - Google Tag Manager
            [['isGoogleTagManagerEnabled'], 'boolean'],
            [['googleTagManagerId'], 'string'],
            [['googleTagManagerId'], 'lahautesociete\tarteaucitron\validators\GoogleTagManagerValidator'],

            // Service - reCAPTCHA
            [['isReCAPTCHAEnabled'], 'boolean'],
            [['reCAPTCHASiteKey'], 'string'],
            [['reCAPTCHASiteKey'], 'lahautesociete\tarteaucitron\validators\ReCAPTCHAValidator'],

            // Service - Google Maps
            [['isGoogleMapsEnabled'], 'boolean'],
            [['googleMapsAPIKey'], 'lahautesociete\tarteaucitron\validators\GoogleMapsValidator'],

            // Service - Google Analytics Universal UA
            [['isGoogleAnalyticsUniversalEnabled'], 'boolean'],
            [['googleAnalyticsUniversalUa'], 'lahautesociete\tarteaucitron\validators\GoogleAnalyticsUniversalValidator'],

            // Service - Google Adwords (conversion)
            [['isGoogleAdwordsConversionEnabled'], 'boolean'],



            [['hashtag'], 'required'],
            [
                [
                    'hashtag', 'orientation', 'cookieDomain', 'customCss',
                ], 'string'
            ],
            [
                [
                    'highPrivacy', 'adblocker', 'showAlertSmall', 'cookieslist', 'removeCredit', 'handleBrowserDNTRequest',
                ], 'boolean'
            ],

            ['hashtag', 'default', 'value' => '#tarteaucitron'],
            ['highPrivacy', 'default', 'value' => false],
            ['orientation', 'default', 'value' => 'top'],
            ['adblocker', 'default', 'value' => false],
            ['showAlertSmall', 'default', 'value' => true],
            ['cookieslist', 'default', 'value' => true],
            ['removeCredit', 'default', 'value' => false],
            ['handleBrowserDNTRequest', 'default', 'value' => false],
            ['cookieDomain', 'default', 'value' => null],
            ['customCss', 'default', 'value' => ""]
        ];
    }
}
