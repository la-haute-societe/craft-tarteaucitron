<?php

/**
 * TarteAuCitron plugin for Craft CMS 3.x
 *
 * tarteaucitron.js integration for Craft CMS 3
 *
 * @link      https://www.lahautesociete.com/
 * @copyright Copyright (c) 2020 La Haute Société
 */

/**
 * TarteAuCitron config.php
 *
 * This file exists only as a template for the TarteAuCitron settings.
 * It does nothing on its own.
 *
 * Don't edit this file, instead copy it to 'craft/config' as 'tarteaucitron.php'
 * and make your changes there to override default settings.
 *
 * Once copied to 'craft/config', this file will be multi-environment aware as
 * well, so you can have different settings groups for each environment, just as
 * you do for 'general.php'
 */

return [
    ///////////////////////////////
    // tarteaucitron.js settings //
    ///////////////////////////////
    /** @var string Privacy policy URL */
    'privacyUrl' => null,

    /** @var string Hashtag — Open panel with this hashtag */
    'hashtag' => '#tarteaucitron',
    /** @var string Cookie name */
    'cookieName' => 'tarteaucitron',

    /** @var string Orientation — Banner position [top|bottom|middle] */
    'orientation' => 'top',

    /** @var bool Show small alert — Display the small banner at the bottom right */
    'showAlertSmall' => true,
    /** @var bool Cookie list — View the list of installed cookies */
    'cookieslist' => true,

    /** @var bool Show icon — Show cookie icon to manage cookies */
    'showIcon' => false,
    /** @var string Icon position — Position of the icon [BottomRight|BottomLeft|TopRight|TopLeft] */
    'iconPosition' => 'BottomRight',

    /** @var bool Adblocker — Display a message if an adblocker is detected */
    'adblocker' => false,

    /** @var bool Deny all CTA — Show the deny all button */
    'denyAllCta' => true,
    /** @var bool Accept all CTA — Show the accept all button when highPrivacy on */
    'acceptAllCta' => false,
    /** @var bool High Privacy — HIGHLY RECOMMANDED Disable auto consent */
    'highPrivacy' => false,

    /** @var bool Handle browser DNT request — If Do Not Track == 1, disallow all */
    'handleBrowserDNTRequest' => false,

    /** @var bool Remove credit — Remove credit link */
    'removeCredit' => false,
    /** @var bool More info link — Show more info link */
    'moreInfoLink' => true,
    /** @var bool Use external CSS — If false, the tarteaucitron.css file will be loaded */
    'useExternalCss' => false,

    /** @var string Cookie domain — Optional - Domain name on which the cookie will be placed (for multisites / subdomains) */
    'cookieDomain' => '',

    /* @var string Change the default readmore link pointing to tarteaucitron.io */
    'readMoreLink' => '',

    /* @var bool Mandatory — Show a message about mandatory cookies */
    'mandatory' => true,


    ///////////////////////////////////
    // Craft plugin specific-options //
    ///////////////////////////////////
    /** @var bool Force tarteaucitron.js language to the same language as Craft */
    'forceLanguage' => true,

    /** @var string Custom CSS — Set custom CSS for tarteaucitron.js */
    'customCss' => '',

    /** @var bool Enable the Google Tag Manager service */
    'isGoogleTagManagerEnabled' => false,
    /** @var string Google Tag Manager ID */
    'googleTagManagerId' => '',

    /** @var bool Enable the FACIL'iti service */
    'isFacilitiEnabled' => false,
    /** @var string FACIL'iti ID */
    'facilitiId' => '',

    /** @var bool Enable the Google Tag Manager service */
    'isReCAPTCHAEnabled' => false,
    /** @var string reCAPTCHA site key */
    'reCAPTCHASiteKey' => '',
    /** @var string Callback name — The name of a globally defined javascript function to call when the reCAPTCHA script has finished loading. */
    'reCAPTCHAMore' => '',

    /** @var bool Enable the Google Maps service */
    'isGoogleMapsEnabled' => false,
    /** @var string Google Maps API KEY */
    'googleMapsAPIKey' => '',

    /** @var bool Enable the Google Analytics service */
    'isGoogleAnalyticsUniversalEnabled' => false,
    /** @var string Analytics UA */
    'googleAnalyticsUniversalUa' => '',
    /** @var string Additional Javascript — Optional - Add here your optional ga.push() */
    'googleAnalyticsUniversalMore' => '',

    /** @var bool Enable the Google AdWords Conversion service */
    'isGoogleAdWordsConversionEnabled' => false,

    /** @var bool Enable the Google AdWords Remarketing service */
    'isGoogleAdWordsRemarketingEnabled' => false,
    /** @var string Google AdWords Remarketing ID */
    'googleAdWordsRemarketingId' => '',

    /** @var bool Enable the Facebook Pixel service */
    'isFacebookPixelEnabled' => false,
    /** @var string Facebook Pixel ID */
    'facebookPixelId' => '',
    /** @var string Additional Javascript — Optional - Add here your optional Facebook Pixel function */
    'facebookPixelMore' => '',

    /** @var bool Enable the LinkedIn service */
    'isLinkedInEnabled' => false,

    /** @var bool Enable the Twitter service */
    'isTwitterEnabled' => false,

    /** @var bool Enable the Vimeo service */
    'isVimeoEnabled' => false,

    /** @var bool Enable the YouTube service */
    'isYoutubeEnabled' => false,

    /** @var bool Enable the YouTube service */
    'isYoutubeJsApiEnabled' => false,
];
