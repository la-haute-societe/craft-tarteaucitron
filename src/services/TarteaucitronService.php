<?php

namespace lahautesociete\tarteaucitron\services;

use Craft;
use craft\base\Component;
use craft\web\View;

use Exception;
use lahautesociete\tarteaucitron\bundles\FrontAsset;
use lahautesociete\tarteaucitron\Tarteaucitron;
use Twig\Markup;

/**
 * Class TarteaucitronService
 * @package lahautesociete\tarteaucitron\services
 */
class TarteaucitronService extends Component
{

    /**
     * Renders tarteaucitron dialog script
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

        $settings = Tarteaucitron::$plugin->getSettings();
        $vars = get_object_vars($settings);

        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron-js/init', $vars);
        Craft::$app->getView()->setTemplateMode($oldMode);

        return new Markup($html, 'UTF-8');
    }

    /**
     * @return Markup
     *
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function renderReCAPTCHA(): Markup
    {
        $settings = Tarteaucitron::$plugin->getSettings();
        $vars = get_object_vars($settings);

        $isReCAPTCHAEnabled = $vars['isReCAPTCHAEnabled'];
        if (!$isReCAPTCHAEnabled) {
            return new Markup('', 'UTF-8');
        }

        $reCAPTCHASiteKey = $vars['reCAPTCHASiteKey'];
        if (empty($reCAPTCHASiteKey)) {
            throw new Exception('craft-tarteaucitron: reCAPTCHASiteKey is empty');
        }

        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron-js/services/recaptcha', $vars);
        Craft::$app->getView()->setTemplateMode($oldMode);

        return new Markup($html, 'UTF-8');
    }

    /**
     * @param array $options
     * @return Markup
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function renderGoogleMaps(array $options): Markup
    {
        $settings = Tarteaucitron::$plugin->getSettings();
        $vars = get_object_vars($settings);

        $isGoogleMapsEnabled = $vars['isGoogleMapsEnabled'];
        if (!$isGoogleMapsEnabled) {
            return new Markup('', 'UTF-8');
        }

        $googleMapsAPIKey = $vars['googleMapsAPIKey'];
        if (empty($googleMapsAPIKey)) {
            throw new Exception('craft-tarteaucitron: googleMapsAPIKey is empty');
        }

        $cOptions = [
            'zoom' => $options['zoom'],
            'latitude' => $options['latitude'],
            'longitude' => $options['longitude'],
            'width' => $options['width'],
            'height' => $options['height'],
        ];
        $vars = array_merge($vars, $cOptions);

        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron-js/services/google-maps', $vars);
        Craft::$app->getView()->setTemplateMode($oldMode);

        return new Markup($html, 'UTF-8');
    }

    /**
     * @param array $options
     * @return Markup
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function renderGoogleAdwordsConversion(array $options): Markup
    {
        $settings = Tarteaucitron::$plugin->getSettings();
        $vars = get_object_vars($settings);

        $isGoogleAdwordsConversionEnabled = $vars['isGoogleAdwordsConversionEnabled'];
        if (!$isGoogleAdwordsConversionEnabled) {
            return new Markup('', 'UTF-8');
        }

        $cOptions = [
            'adwordsconversionId' => $options['adwordsconversionId'],
            'label' => $options['label'],
            'language' => $options['language'],
            'format' => $options['format'],
            'color' => $options['color'],
            'value' => $options['value'],
            'currency' => $options['currency'],
            'custom1' => $options['custom1'] ? $options['custom1'] : '',
            'custom2' => $options['custom2'] ? $options['custom2'] : '',
        ];
        $vars = array_merge($vars, $cOptions);

        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron-js/services/google-adwords-conversion', $vars);
        Craft::$app->getView()->setTemplateMode($oldMode);

        return new Markup($html, 'UTF-8');
    }

    /**
     * @param array $options
     * @return Markup
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function renderLinkedin(array $options): Markup
    {
        $settings = Tarteaucitron::$plugin->getSettings();
        $vars = get_object_vars($settings);

        $isLinkedinEnabled = $vars['isLinkedinEnabled'];
        if (!$isLinkedinEnabled) {
            return new Markup('', 'UTF-8');
        }

        $cOptions = [
            'counter' => $options['counter'] ? $options['counter'] : null,
        ];
        $vars = array_merge($vars, $cOptions);

        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron-js/services/linkedin', $vars);
        Craft::$app->getView()->setTemplateMode($oldMode);

        return new Markup($html, 'UTF-8');
    }

    /**
     * @param array $options
     * @return Markup
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function renderTwitter(array $options): Markup
    {
        $settings = Tarteaucitron::$plugin->getSettings();
        $vars = get_object_vars($settings);

        $isTwitterEnabled = $vars['isTwitterEnabled'];
        if (!$isTwitterEnabled) {
            return new Markup('', 'UTF-8');
        }

        $cOptions = [
            'username' => $options['username'],
            'type' => $options['type'],
            'size' => $options['size'] ? $options['size'] : 'normal',
            'countPosition' => $options['countPosition'] ? $options['countPosition'] : 'null',
        ];
        $vars = array_merge($vars, $cOptions);

        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron-js/services/twitter', $vars);
        Craft::$app->getView()->setTemplateMode($oldMode);

        return new Markup($html, 'UTF-8');
    }

    /**
     * @param array $options
     * @return Markup
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function renderVimeo(array $options): Markup
    {
        $settings = Tarteaucitron::$plugin->getSettings();
        $vars = get_object_vars($settings);

        $isVimeoEnabled = $vars['isVimeoEnabled'];
        if (!$isVimeoEnabled) {
            return new Markup('', 'UTF-8');
        }

        $cOptions = [
            'videoId' => $options['videoId'],
            'width' => $options['width'],
            'height' => $options['height'],
        ];
        $vars = array_merge($vars, $cOptions);

        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron-js/services/vimeo', $vars);
        Craft::$app->getView()->setTemplateMode($oldMode);

        return new Markup($html, 'UTF-8');
    }
}
