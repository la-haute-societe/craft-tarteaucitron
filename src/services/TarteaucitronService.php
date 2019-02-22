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
     * @param array $params
     * @return Markup
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function renderGoogleMaps($zoom, $latitude, $longitude, $width, $height): Markup
    {
        $settings = Tarteaucitron::$plugin->getSettings();
        $vars = get_object_vars($settings);
        $vars ['zoom'] = $zoom;
        $vars ['latitude'] = $latitude;
        $vars ['longitude'] = $longitude;
        $vars ['width'] = $width;
        $vars ['height'] = $height;

        $isGoogleMapsEnabled = $vars['isGoogleMapsEnabled'];
        if (!$isGoogleMapsEnabled) {
            return new Markup('', 'UTF-8');
        }

        $googleMapsAPIKey = $vars['googleMapsAPIKey'];
        if (empty($googleMapsAPIKey)) {
            throw new Exception('craft-tarteaucitron: googleMapsAPIKey is empty');
        }

        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron-js/services/google-maps', $vars);
        Craft::$app->getView()->setTemplateMode($oldMode);

        return new Markup($html, 'UTF-8');
    }
}
