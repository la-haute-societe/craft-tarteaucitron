<?php /** @noinspection PhpUnused */

namespace lhs\tarteaucitron\models;

use craft\base\Model;
use craft\validators\ArrayValidator;
use lhs\tarteaucitron\validators\FacebookPixelValidator;
use lhs\tarteaucitron\validators\GoogleAdWordsRemarketingValidator;
use lhs\tarteaucitron\validators\GoogleAnalyticsUniversalValidator;
use lhs\tarteaucitron\validators\GoogleMapsValidator;
use lhs\tarteaucitron\validators\GoogleTagManagerValidator;
use lhs\tarteaucitron\validators\ReCAPTCHAValidator;

/**
 * Class SettingsModel
 * @package lhs\tarteaucitron\models
 */
class SettingsModel extends Model
{
    ///////////////////////////////
    // tarteaucitron.js settings //
    ///////////////////////////////
    /** @var ?string The URL of the privacy policy  */
    public ?string $privacyUrl = null;

    /** @var string A string that, when appended to the URL, triggers the opening of the tarteaucitron.js panel */
    public string $hashtag = '#tarteaucitron';

    /** @var string The name of the cookie used by tarteaucitron.js to store user preferences */
    public string $cookieName = 'tarteaucitron';

    /** @var string The position of the tarteaucitron.js banner. Allowed values: top, bottom, middle, popup */
    public string $orientation = 'top';

    /** @var bool Whether to show the small tarteaucitron.js banner on bottom right of the screen */
    public bool $showAlertSmall = true;

    /** @var bool Whether to show the cookie list in the small tarteaucitron.js banner */
    public bool $cookieslist = true;

    /** @var bool Whether to show a floating icon to open the tarteaucitron.js panel */
    public bool $showIcon = true;

    /** @var string The position of the floating icon. Allowed values: BottomRight, BottomLeft, TopRight and TopLeft */
    public string $iconPosition = 'BottomRight';

    /** @var ?string URL or base64 encoded image to use as the floating icon
     * TODO: Honor this new setting
     */
    public ?string $iconSrc = null;

    /** @var bool Whether to display a warning message if an ad blocker is detected */
    public bool $adblocker = false;

    /** @var bool Whether to show the "Deny All" button. You have to, to comply with GDPR. */
    public bool $denyAllCta = true;

    /** @var bool Whether to show the "Accept All" button when $highPrivacy is true */
    public bool $acceptAllCta = false;

    /** @var bool Whether to disabled auto-consent on scroll or navigation. You have to, to comply with GDPR. */
    public bool $highPrivacy = false;

    /** @var bool Whether to honor the browser "Do Not Track" (DNT) HTTP header. If true and the browser send DNT == 1, all tarteaucitron.js services are disabled. */
    public bool $handleBrowserDNTRequest = false;

    /** @var bool Whether to remove the tarteaucitron.js credit link */
    public bool $removeCredit = false;

    /** @var bool Whether to show links to the service details page on tarteaucitron.io and to the official service privacy policy  */
    public bool $moreInfoLink = true;

    /** @var bool Whether to use external CSS. When enabled, the tarteaucitron.js default stylesheet will not be automatically loaded. */
    public bool $useExternalCss = false;

    /** @var ?string The domain name of the tarteaucitron.js cookie */
    public ?string $cookieDomain = null;

    /** @var string|null A single URL to use instead of the link to service details pages on tarteaucitron.io */
    public ?string $readMoreLink = null;

    /** @var bool Whether to display a message indicating that mandatory cookies are used */
    public bool $mandatory = true;

    /** @var bool Whether to show a disabled "Allowed" button next to the message about mandatory cookies.
     * TODO: Honor this new setting
     */
    public bool $mandatoryCta = true;


    ///////////////////////////////////
    // Craft plugin specific-options //
    ///////////////////////////////////
    /** @var bool Whether to force the tarteaucitron.js language to be the same as the current Craft site's language */
    public bool $forceLanguage = true;

    /** @var ?string Custom CSS to customize tarteaucitron.js (will be output in the <head> element) */
    public ?string $customCss = null;

    /** @var bool Whether the FACIL'iti tarteaucitron.js service is enabled */
    public bool $isFacilitiEnabled = false;

    /** @var ?string The FACIL'ITI customer ID */
    public ?string $facilitiId = null;

    /** @var bool Whether the Google Tag Manager tarteaucitron.js service is enabled */
    public bool $isGoogleTagManagerEnabled = false;

    /** @var ?string The Google Tag Manager ID */
    public ?string $googleTagManagerId = null;

    /** @var bool Whether the reCAPTCHA tarteaucitron.js service is enabled */
    public bool $isReCAPTCHAEnabled = false;

    /** @var ?string The reCAPTCHA site key */
    public ?string $reCAPTCHASiteKey = null;

    /** @var ?string Javascript code to execute when the reCAPTCHA tarteaucitron.js service has been loaded */
    public ?string $reCAPTCHAMore = null;

    /** @var bool Whether the Google Maps tarteaucitron.js service is enabled */
    public bool $isGoogleMapsEnabled = false;

    /** @var ?string The Google Maps API key */
    public ?string $googleMapsAPIKey = null;

    /**
     * @var string[] A list of Google Maps libraries names.
     * See https://developers.google.com/maps/documentation/javascript/libraries for details on allowed values
     */
    public array $googleMapsLibraries = [];

    /** @var ?string The name of a javascript global function to execute when Google Maps is initialized */
    public ?string $googleMapsCallbackName = null;

    /** @var bool Whether the Google Analytics tarteaucitron.js service is enabled */
    public bool $isGoogleAnalyticsUniversalEnabled = false;

    /** @var ?string The Google Analytics ID */
    public ?string $googleAnalyticsUniversalUa = null;

    /** @var ?string Javascript code to execute when the Google Analytics tarteaucitron.js service has been loaded */
    public ?string $googleAnalyticsUniversalMore = null;

    /** @var bool Whether the Google Ads conversion tarteaucitron.js service is enabled */
    public bool $isGoogleAdWordsConversionEnabled = false;

    /** @var bool Whether the Google Ads remarketing tarteaucitron.js service is enabled */
    public bool $isGoogleAdWordsRemarketingEnabled = false;

    /** @var ?string The Google Ads remarketing ID */
    public ?string $googleAdWordsRemarketingId = null;

    /** @var bool Whether the Facebook Pixel tarteaucitron.js service is enabled */
    public bool $isFacebookPixelEnabled = false;

    /** @var ?string The Facebook Pixel ID */
    public ?string $facebookPixelId = null;

    /** @var ?string Javascript code to execute when the Facebook Pixel tarteaucitron.js service has been loaded */
    public ?string $facebookPixelMore = null;

    /** @var bool Whether the LinkedIn tarteaucitron.js service is enabled */
    public bool $isLinkedInEnabled = false;

    /** @var bool Whether the Twitter tarteaucitron.js service is enabled */
    public bool $isTwitterEnabled = false;

    /** @var bool Whether the Vimeo tarteaucitron.js service is enabled */
    public bool $isVimeoEnabled = false;

    /** @var bool Whether the YouTube tarteaucitron.js service is enabled */
    public bool $isYoutubeEnabled = false;

    /** @var bool Whether the YouTube JS API tarteaucitron.js service is enabled */
    public bool $isYoutubeJsApiEnabled = false;


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
            [['facebookPixelId'], FacebookPixelValidator::class],

            // Service - Google AdWords (conversion)
            [['isGoogleAdWordsConversionEnabled'], 'boolean'],

            // Service - Google AdWords (remarketing)
            [['isGoogleAdWordsRemarketingEnabled'], 'boolean'],
            [['googleAdWordsRemarketingId'], GoogleAdWordsRemarketingValidator::class],

            // Service - Google Analytics Universal UA
            [['isGoogleAnalyticsUniversalEnabled'], 'boolean'],
            [['googleAnalyticsUniversalUa'], GoogleAnalyticsUniversalValidator::class],

            // Service - Google Maps
            [['isGoogleMapsEnabled'], 'boolean'],
            [['googleMapsAPIKey'], GoogleMapsValidator::class],
            [['googleMapsLibraries'], ArrayValidator::class],
            [['googleMapsCallbackName'], 'string'],

            // Service - Google Tag Manager
            [['isGoogleTagManagerEnabled'], 'boolean'],
            [['googleTagManagerId'], 'string'],
            [['googleTagManagerId'], GoogleTagManagerValidator::class],

            // Service - LinkedIn
            [['isLinkedInEnabled'], 'boolean'],

            // Service - Twitter
            [['isTwitterEnabled'], 'boolean'],

            // Service - reCAPTCHA
            [['isReCAPTCHAEnabled'], 'boolean'],
            [['reCAPTCHASiteKey', 'reCAPTCHAMore'], 'string'],
            [['reCAPTCHASiteKey'], ReCAPTCHAValidator::class],

            // Service - Vimeo
            [['isVimeoEnabled'], 'boolean'],

            // Service - YouTube
            [['isYoutubeEnabled'], 'boolean'],

            // Service - YouTube
            [['isYoutubeJsApiEnabled'], 'boolean'],
        ];
    }
}
