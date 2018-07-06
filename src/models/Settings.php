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
    public $isReCaptchaEnabled = false;

    /**
     * @var string
     */
    public $reCaptchaSiteKey = '';

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
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['hashtag'], 'required'],
            [['googleTagManagerId'], 'lahautesociete\tarteaucitron\validators\GoogleTagManagerValidator'],
            [['reCaptchaSiteKey'], 'lahautesociete\tarteaucitron\validators\ReCaptchaValidator'],
            [['googleAnalyticsUniversalUa'], 'lahautesociete\tarteaucitron\validators\GoogleAnalyticsUniversalValidator'],

            [
                [
                    'hashtag', 'orientation', 'cookieDomain', 'customCss',
                    'googleTagManagerId', 'reCaptchaSiteKey'
                ], 'string'
            ],
            [
                [
                    'highPrivacy', 'adblocker', 'showAlertSmall', 'cookieslist', 'removeCredit', 'handleBrowserDNTRequest',
                    'isGoogleTagManagerEnabled', 'isReCaptchaEnabled', 'isGoogleAnalyticsUniversalEnabled'
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

    public function ruleGoogleTagManager($attribute)
    {
        if ($this->isGoogleTagManagerEnabled && empty($this->$attribute)) {
            $this->addError($attribute, Craft::t('yii', '{attribute} cannot be blank.', [
                'attribute' => $attribute
            ]));
        }
    }
}
