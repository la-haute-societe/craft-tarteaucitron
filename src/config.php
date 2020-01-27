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
 * Don't edit this file, instead copy it to 'craft/config' as 'tarteaucitron-js.php'
 * and make your changes there to override default settings.
 *
 * Once copied to 'craft/config', this file will be multi-environment aware as
 * well, so you can have different settings groups for each environment, just as
 * you do for 'general.php'
 */

return [
    /** @var string Hashtag — Open panel automatically with this hashtag in URL */
    'hashtag'                           => '#tarteaucitron',
    /** @var bool High Privacy — Disable implied consent (while browsing) */
    'highPrivacy'                       => false,
    /** @var bool Accept all CTA — Show the accept all button when highPrivacy on */
    'acceptAllCta'                      => false,
    /** @var string Orientation — Banner position */
    'orientation'                       => "top",
    /** @var bool Adblocker — Display a message if an adblocker is detected */
    'adblocker'                         => false,
    /** @var bool Show small alert — Display the small banner at the bottom right */
    'showAlertSmall'                    => true,
    /** @var bool Cookie list — View the list of installed cookies */
    'cookieslist'                       => true,
    /** @var bool Remove credit — Delete the link to the source */
    'removeCredit'                      => false,
    /** @var bool Handle browser DNT request — Respond to the DoNotTrack request */
    'handleBrowserDNTRequest'           => false,
    /** @var string Cookie domain — Optional - Domain name on which the cookie will be placed (for multisites / subdomains) */
    'cookieDomain'                      => '',
    /** @var string Custom CSS — Set custom CSS for tarteaucitron.js */
    'customCss'                         => '',

    /** @var bool Enable the Google Tag Manager service */
    'isGoogleTagManagerEnabled'         => false,
    /** @var string Google Tag Manager ID */
    'googleTagManagerId'                => '',

    /** @var bool Enable the Google Tag Manager service */
    'isReCAPTCHAEnabled'                => false,
    /** @var string reCAPTCHA site key */
    'reCAPTCHASiteKey'                  => '',
    /** @var string Callback name — The name of a globally defined javascript function to call when the reCAPTCHA script has finished loading. */
    'reCAPTCHACallbackName'             => '',

    /** @var bool Enable the Google Maps service */
    'isGoogleMapsEnabled'               => false,
    /** @var string Google Maps API KEY */
    'googleMapsAPIKey'                  => '',

    /** @var bool Enable the Google Analytics service */
    'isGoogleAnalyticsUniversalEnabled' => false,
    /** @var string Analytics UA */
    'googleAnalyticsUniversalUa'        => '',
    /** @var string Additional Javascript — Optional - Add here your optional ga.push() */
    'googleAnalyticsUniversalMore'      => '',

    /** @var bool Enable the Google AdWords Conversion service */
    'isGoogleAdwordsConversionEnabled'  => false,

    /** @var bool Enable the Google AdWords Remarketing service */
    'isGoogleAdwordsRemarketingEnabled' => false,
    /** @var string Google Adwords Remarketing ID */
    'googleAdwordsRemarketingId'        => '',

    /** @var bool Enable the Facebook Pixel service */
    'isFacebookPixelEnabled'            => false,
    /** @var string Facebook Pixel ID */
    'facebookPixelId'                   => '',
    /** @var string Additional Javascript — Optional - Add here your optional Facebook Pixel function */
    'facebookPixelMore'                 => '',

    /** @var bool Enable the LinkedIn service */
    'isLinkedInEnabled'                 => false,

    /** @var bool Enable the Twitter service */
    'isTwitterEnabled'                  => false,

    /** @var bool Enable the Vimeo service */
    'isVimeoEnabled'                    => false,

    /** @var bool Enable the YouTube service */
    'isYoutubeEnabled'                  => false,
];
