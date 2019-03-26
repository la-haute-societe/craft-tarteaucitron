<?php

namespace lahautesociete\tarteaucitron\services;

use Craft;
use craft\base\Component;
use craft\web\View;

use Exception;
use lahautesociete\tarteaucitron\bundles\FrontAsset;
use lahautesociete\tarteaucitron\models\services\GoogleAdwordsConversionServiceModel;
use lahautesociete\tarteaucitron\models\services\GoogleMapsServiceModel;
use lahautesociete\tarteaucitron\models\services\LinkedinServiceModel;
use lahautesociete\tarteaucitron\models\services\ReCAPTCHAServiceModel;
use lahautesociete\tarteaucitron\models\services\TwitterServiceModel;
use lahautesociete\tarteaucitron\models\services\VimeoServiceModel;
use lahautesociete\tarteaucitron\models\services\YoutubeServiceModel;
use lahautesociete\tarteaucitron\Tarteaucitron;
use Twig\Markup;

/**
 * Class TarteaucitronService
 * @package lahautesociete\tarteaucitron\services
 */
class TarteaucitronService extends Component
{
    /**
     * @return array
     */
    private function getSettingsVars()
    {
        $settings = Tarteaucitron::$plugin->getSettings();
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
}
