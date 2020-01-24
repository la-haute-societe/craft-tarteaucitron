<?php

namespace lhs\tarteaucitron\services;

use Craft;
use craft\base\Component;
use craft\web\View;

use Exception;
use lhs\tarteaucitron\bundles\FrontAsset;
use lhs\tarteaucitron\models\services\GoogleAdwordsConversionServiceModel;
use lhs\tarteaucitron\models\services\GoogleMapsServiceModel;
use lhs\tarteaucitron\models\services\LinkedinServiceModel;
use lhs\tarteaucitron\models\services\ReCAPTCHAServiceModel;
use lhs\tarteaucitron\models\services\TwitterServiceModel;
use lhs\tarteaucitron\models\services\VimeoServiceModel;
use lhs\tarteaucitron\models\services\YoutubeServiceModel;
use lhs\tarteaucitron\Tarteaucitron;
use Twig\Markup;

/**
 * Class TarteaucitronService
 * @package lhs\tarteaucitron\services
 */
class TarteaucitronService extends Component
{
    /**
     * @return array
     */
    private function getSettingsVars()
    {
        $settings = Tarteaucitron::getInstance()->getSettings();
        return get_object_vars($settings);
    }

    /**
     * Call tarteaucitron init script
     *
     * @return Markup
     *
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function renderInitScript(): Markup
    {
        Craft::$app->getView()->registerAssetBundle(FrontAsset::class);
        $vars = $this->getSettingsVars();

        $html = $this->getInitHtml($vars);
        return new Markup($html, 'UTF-8');
    }

    /**
     *
     * @param array $vars
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    private function getInitHtml(array $vars)
    {
        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron-js/init', $vars);
        Craft::$app->getView()->setTemplateMode($oldMode);
        return $html;
    }

    /**
     * @param array $options
     * @return Markup
     * @throws Exception
     */
    public function renderReCAPTCHA(array $options): Markup
    {
        $settingsVars = $this->getSettingsVars();
        $vars = array_merge($settingsVars, $options);

        $model = new ReCAPTCHAServiceModel();
        $model->setAttributes($vars);
        $model->validateAndThrowErrors();

        return $model->getHtml();
    }


    /**
     * @param array $options
     * @return Markup
     * @throws Exception
     */
    public function renderGoogleMaps(array $options): Markup
    {
        $settingsVars = $this->getSettingsVars();
        $vars = array_merge($settingsVars, $options);

        $model = new GoogleMapsServiceModel();
        $model->setAttributes($vars);
        $model->validateAndThrowErrors();

        return $model->getHtml();
    }

    /**
     * @param array $options
     * @return Markup
     * @throws Exception
     */
    public function renderGoogleAdwordsConversion(array $options): Markup
    {
        $settingsVars = $this->getSettingsVars();
        $vars = array_merge($settingsVars, $options);

        $model = new GoogleAdwordsConversionServiceModel();
        $model->setAttributes($vars);
        $model->validateAndThrowErrors();

        return $model->getHtml();
    }

    /**
     * @param array $options
     * @return Markup
     * @throws Exception
     */
    public function renderLinkedin(array $options): Markup
    {
        $settingsVars = $this->getSettingsVars();
        $vars = array_merge($settingsVars, $options);

        $model = new LinkedinServiceModel();
        $model->setAttributes($vars);
        $model->validateAndThrowErrors();

        return $model->getHtml();
    }

    /**
     * @param array $options
     * @return Markup
     * @throws Exception
     */
    public function renderTwitter(array $options): Markup
    {
        $settingsVars = $this->getSettingsVars();
        $vars = array_merge($settingsVars, $options);

        $model = new TwitterServiceModel();
        $model->setAttributes($vars);
        $model->validateAndThrowErrors();

        return $model->getHtml();
    }

    /**
     * @param array $options
     * @return Markup
     * @throws Exception
     */
    public function renderVimeo(array $options): Markup
    {
        $settingsVars = $this->getSettingsVars();
        $vars = array_merge($settingsVars, $options);

        $model = new VimeoServiceModel();
        $model->setAttributes($vars);
        $model->validateAndThrowErrors();

        return $model->getHtml();
    }

    /**
     * @param array $options
     * @return Markup
     * @throws Exception
     */
    public function renderYoutube(array $options): Markup
    {
        $settingsVars = $this->getSettingsVars();
        $vars = array_merge($settingsVars, $options);

        $model = new YoutubeServiceModel();
        $model->setAttributes($vars);
        $model->validateAndThrowErrors();

        return $model->getHtml();
    }

    public function isFacebookPixelEnabled(): bool
    {
        return (bool)$this->getSettingsVars()['isFacebookPixelEnabled'];
    }

    public function isGoogleTagManagerEnabled(): bool
    {
        return (bool)$this->getSettingsVars()['isGoogleTagManagerEnabled'];
    }

    public function isReCAPTCHAEnabled(): bool
    {
        return (bool)$this->getSettingsVars()['isReCAPTCHAEnabled'];
    }

    public function isGoogleMapsEnabled(): bool
    {
        return (bool)$this->getSettingsVars()['isGoogleMapsEnabled'];
    }

    public function isGoogleAnalyticsUniversalEnabled(): bool
    {
        return (bool)$this->getSettingsVars()['isGoogleAnalyticsUniversalEnabled'];
    }

    public function isGoogleAdwordsConversionEnabled(): bool
    {
        return (bool)$this->getSettingsVars()['isGoogleAdwordsConversionEnabled'];
    }

    public function isGoogleAdwordsRemarketingEnabled(): bool
    {
        return (bool)$this->getSettingsVars()['isGoogleAdwordsRemarketingEnabled'];
    }

    public function isLinkedinEnabled(): bool
    {
        return (bool)$this->getSettingsVars()['isLinkedinEnabled'];
    }

    public function isTwitterEnabled(): bool
    {
        return (bool)$this->getSettingsVars()['isTwitterEnabled'];
    }

    public function isVimeoEnabled(): bool
    {
        return (bool)$this->getSettingsVars()['isVimeoEnabled'];
    }

    public function isYoutubeEnabled(): bool
    {
        return (bool)$this->getSettingsVars()['isYoutubeEnabled'];
    }
}
