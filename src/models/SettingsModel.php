<?php

namespace lhs\tarteaucitron\models;

use craft\base\Model;
use craft\validators\ArrayValidator;

/**
 * Class SettingsModel
 * @package lhs\tarteaucitron\models
 */
class SettingsModel extends Model
{
    ///////////////////////////////
    // tarteaucitron.js settings //
    ///////////////////////////////
    /** @var string */
    public $privacyUrl = null;

    /** @var string */
    public $hashtag = '#tarteaucitron';
    /** @var string */
    public $cookieName = 'tarteaucitron';

    /** @var string */
    public $orientation = "top";

    /** @var bool */
    public $showAlertSmall = true;
    /** @var bool */
    public $cookieslist = true;

    /** @var bool */
    public $showIcon = true;
    /** @var bool */
    public $iconPosition = 'BottomRight';

    /** @var bool */
    public $adblocker = false;

    /** @var bool */
    public $denyAllCta = true;
    /** @var bool */
    public $acceptAllCta = false;
    /** @var bool */
    public $highPrivacy = false;

    /** @var bool */
    public $handleBrowserDNTRequest = false;

    /** @var bool */
    public $removeCredit = false;
    /** @var bool More info link — Show more info link */
    public $moreInfoLink = true;
    /** @var bool */
    public $useExternalCss = false;

    /** @var string */
    public $cookieDomain = null;

    /** @var string */
    public $readMoreLink = null;

    /** @var bool */
    public $mandatory = true;

    ///////////////////////////////////
    // Craft plugin specific-options //
    ///////////////////////////////////

    /** @var string */
    public $customCss = null;

    /** @var boolean */
    public $isGoogleTagManagerEnabled = false;

    /** @var string */
    public $googleTagManagerId = null;

    /** @var boolean */
    public $isReCAPTCHAEnabled = false;

    /** @var string */
    public $reCAPTCHASiteKey = null;

    /** @var string */
    public $reCAPTCHAMore = null;

    /** @var boolean */
    public $isGoogleMapsEnabled = false;

    /** @var string */
    public $googleMapsAPIKey = null;

    /** @var string[] */
    public $googleMapsLibraries = [];

    /** @var string */
    public $googleMapsCallbackName;

    /** @var boolean */
    public $isGoogleAnalyticsUniversalEnabled = false;

    /** @var string */
    public $googleAnalyticsUniversalUa = null;

    /** @var string */
    public $googleAnalyticsUniversalMore = null;

    /** @var boolean */
    public $isGoogleAdWordsConversionEnabled = false;

    /** @var boolean */
    public $isGoogleAdWordsRemarketingEnabled = false;

    /** @var string */
    public $googleAdWordsRemarketingId = null;

    /** @var boolean */
    public $isFacebookPixelEnabled = false;

    /** @var string */
    public $facebookPixelId = null;

    /** @var string */
    public $facebookPixelMore = null;

    /** @var boolean */
    public $isLinkedInEnabled = false;

    /** @var boolean */
    public $isTwitterEnabled = false;

    /** @var boolean */
    public $isVimeoEnabled = false;

    /** @var boolean */
    public $isYoutubeEnabled = false;

    /** @var boolean */
    public $isYoutubeJsApiEnabled = false;


    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            // Core
            [['hashtag', 'cookieName'], 'required'],
            [['privacyUrl', 'hashtag', 'cookieName', 'orientation', 'iconPosition', 'cookieDomain', 'customCss'], 'string'],
            [['showAlertSmall', 'cookieslist', 'showIcon', 'adblocker', 'denyAllCta', 'acceptAllCta', 'highPrivacy', 'handleBrowserDNTRequest', 'removeCredit', 'moreInfoLink', 'useExternalCss', 'mandatory'], 'boolean'],

            // Service - Facebook Pixel
            [['isFacebookPixelEnabled'], 'boolean'],
            [['facebookPixelId'], 'lhs\tarteaucitron\validators\FacebookPixelValidator'],

            // Service - Google AdWords (conversion)
            [['isGoogleAdWordsConversionEnabled'], 'boolean'],

            // Service - Google AdWords (remarketing)
            [['isGoogleAdWordsRemarketingEnabled'], 'boolean'],
            [['googleAdWordsRemarketingId'], 'lhs\tarteaucitron\validators\GoogleAdWordsRemarketingValidator'],

            // Service - Google Analytics Universal UA
            [['isGoogleAnalyticsUniversalEnabled'], 'boolean'],
            [['googleAnalyticsUniversalUa'], 'lhs\tarteaucitron\validators\GoogleAnalyticsUniversalValidator'],

            // Service - Google Maps
            [['isGoogleMapsEnabled'], 'boolean'],
            [['googleMapsAPIKey'], 'lhs\tarteaucitron\validators\GoogleMapsValidator'],
            [['googleMapsLibraries'], ArrayValidator::class],
            [['googleMapsCallbackName'], 'string'],

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

            // Service - Youtube
            [['isYoutubeJsApiEnabled'], 'boolean'],
        ];
    }
}
