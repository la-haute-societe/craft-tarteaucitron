<?php

namespace lhs\tarteaucitron\models;

use craft\base\Model;

/**
 * Class SettingsModel
 * @package lhs\tarteaucitron\models
 */
class SettingsModel extends Model
{
    /** @var string */
    public $hashtag = '#tarteaucitron';

    /** @var bool */
    public $highPrivacy = false;

    /** @var bool */
    public $acceptAllCta = false;

    /** @var string */
    public $orientation = "top";

    /** @var bool */
    public $adblocker = false;

    /** @var bool */
    public $showAlertSmall = true;

    /** @var bool */
    public $cookieslist = true;

    /** @var bool */
    public $removeCredit = false;

    /** @var bool */
    public $handleBrowserDNTRequest = false;

    /** @var string */
    public $cookieDomain = '';

    /** @var string */
    public $customCss = '';

    /** @var boolean */
    public $isGoogleTagManagerEnabled = false;

    /** @var string */
    public $googleTagManagerId = '';

    /** @var boolean */
    public $isReCAPTCHAEnabled = false;

    /** @var string */
    public $reCAPTCHASiteKey = '';

    /** @var string */
    public $reCAPTCHAMore = '';

    /** @var boolean */
    public $isGoogleMapsEnabled = false;

    /** @var string */
    public $googleMapsAPIKey = '';

    /** @var boolean */
    public $isGoogleAnalyticsUniversalEnabled = false;

    /** @var string */
    public $googleAnalyticsUniversalUa = '';

    /** @var string */
    public $googleAnalyticsUniversalMore = '';

    /** @var boolean */
    public $isGoogleAdwordsConversionEnabled = false;

    /** @var boolean */
    public $isGoogleAdwordsRemarketingEnabled = false;

    /** @var string */
    public $googleAdwordsRemarketingId = '';

    /** @var boolean */
    public $isFacebookPixelEnabled = false;

    /** @var string */
    public $facebookPixelId = '';

    /** @var string */
    public $facebookPixelMore = '';

    /** @var boolean */
    public $isLinkedInEnabled = false;

    /** @var boolean */
    public $isTwitterEnabled = false;

    /** @var boolean */
    public $isVimeoEnabled = false;

    /** @var boolean */
    public $isYoutubeEnabled = false;


    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            // Core
            [['hashtag'], 'required'],
            [['hashtag', 'orientation', 'cookieDomain', 'customCss',], 'string'],
            [['highPrivacy', 'adblocker', 'showAlertSmall', 'cookieslist', 'removeCredit', 'handleBrowserDNTRequest', 'acceptAllCta'], 'boolean'],

            // Service - Facebook Pixel
            [['isFacebookPixelEnabled'], 'boolean'],
            [['facebookPixelId'], 'lhs\tarteaucitron\validators\FacebookPixelValidator'],

            // Service - Google Adwords (conversion)
            [['isGoogleAdwordsConversionEnabled'], 'boolean'],

            // Service - Google Adwords (remarketing)
            [['isGoogleAdwordsRemarketingEnabled'], 'boolean'],
            [['googleAdwordsRemarketingId'], 'lhs\tarteaucitron\validators\GoogleAdwordsRemarketingValidator'],

            // Service - Google Analytics Universal UA
            [['isGoogleAnalyticsUniversalEnabled'], 'boolean'],
            [['googleAnalyticsUniversalUa'], 'lhs\tarteaucitron\validators\GoogleAnalyticsUniversalValidator'],

            // Service - Google Maps
            [['isGoogleMapsEnabled'], 'boolean'],
            [['googleMapsAPIKey'], 'lhs\tarteaucitron\validators\GoogleMapsValidator'],

            // Service - Google Tag Manager
            [['isGoogleTagManagerEnabled'], 'boolean'],
            [['googleTagManagerId'], 'string'],
            [['googleTagManagerId'], 'lhs\tarteaucitron\validators\GoogleTagManagerValidator'],

            // Service - Linkedin
            [['isLinkedInEnabled'], 'boolean'],

            // Service - Twitter
            [['isTwitterEnabled'], 'boolean'],

            // Service - reCAPTCHA
            [['isReCAPTCHAEnabled'], 'boolean'],
            [['reCAPTCHASiteKey', 'reCAPTCHAMore'], 'string'],
            [['reCAPTCHASiteKey'], 'lhs\tarteaucitron\validators\ReCAPTCHAValidator'],

            // Service - Vimeo
            [['isVimeoEnabled'], 'boolean'],

            // Service - Youtube
            [['isYoutubeEnabled'], 'boolean'],
        ];
    }
}
