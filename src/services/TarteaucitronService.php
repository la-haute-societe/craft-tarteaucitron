<?php

namespace lahautesociete\tarteaucitron\services;

use Craft;
use craft\base\Component;
use craft\web\View;

use Exception;
use lahautesociete\tarteaucitron\bundles\FrontAsset;
use lahautesociete\tarteaucitron\models\services\ReCAPTCHAServiceModel;
use lahautesociete\tarteaucitron\Tarteaucitron;
use Twig\Markup;
use yii\helpers\Html;

/**
 * Class TarteaucitronService
 * @package lahautesociete\tarteaucitron\services
 */
class TarteaucitronService extends Component
{
    /**
     * @return array
     */
    private function getSettingsVars() {
        $settings = Tarteaucitron::$plugin->getSettings();
        return get_object_vars($settings);
    }

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
        $vars = $this->getSettingsVars();

        $html = $this->getInitHtml($vars);
        return new Markup($html, 'UTF-8');
    }

    /**
     * @param array $vars
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    private function getInitHtml(array $vars) {
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
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     * @throws Exception
     */
    public function renderGoogleMaps(array $options): Markup
    {
        // Check if service is enabled
        $vars = $this->getSettingsVars();
        if (!$vars['isGoogleMapsEnabled']) {
            return new Markup('', 'UTF-8');
        }

        // Check if required parameters are set
        if (empty($vars['googleMapsAPIKey'])) {
            throw new Exception('craft-tarteaucitron: googleMapsAPIKey is empty');
        }

        // Cast options
        $castedOptions = [
            'zoom' => $options['zoom'],
            'latitude' => $options['latitude'],
            'longitude' => $options['longitude'],
            'width' => $options['width'],
            'height' => $options['height'],
            'attributes' => array_key_exists('attributes', $options) ? $options['attributes'] : [],
        ];
        $vars = array_merge($vars, $castedOptions);

        $html = $this->getGoogleMapsHtml($vars);
        return new Markup($html, 'UTF-8');
    }

    /**
     * @param array $vars
     * @return string
     */
    private function getGoogleMapsHtml(array $vars)
    {
        $vars['attributes']['zoom'] = $vars['zoom'];
        $vars['attributes']['latitude'] = $vars['latitude'];
        $vars['attributes']['longitude'] = $vars['longitude'];
        Html::addCssClass($vars['attributes'], 'googlemaps-canvas');
        Html::addCssStyle($vars['attributes'], sprintf('width: %s; height: %s;', $vars['width'], $vars['height']));
        return Html::tag('div', '', $vars['attributes']);
    }

    /**
     * @param array $options
     * @return Markup
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function renderGoogleAdwordsConversion(array $options): Markup
    {
        // Check if service is enabled
        $vars = $this->getSettingsVars();
        if (!$vars['isGoogleAdwordsConversionEnabled']) {
            return new Markup('', 'UTF-8');
        }

        // Cast options
        $castedOptions = [
            'adwordsconversionId' => $options['adwordsconversionId'],
            'label' => $options['label'],
            'language' => $options['language'],
            'format' => $options['format'],
            'color' => $options['color'],
            'value' => $options['value'],
            'currency' => $options['currency'],
            'custom1' => array_key_exists('custom1', $options) ? $options['custom1'] : '',
            'custom2' => array_key_exists('custom2', $options) ? $options['custom2'] : '',
        ];
        $vars = array_merge($vars, $castedOptions);

        $html = $this->getGoogleAdwordsConversionHtml($vars);
        return new Markup($html, 'UTF-8');
    }

    /**
     * @param array $vars
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    private function getGoogleAdwordsConversionHtml(array $vars)
    {
        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron-js/services/google-adwords-conversion', $vars);
        Craft::$app->getView()->setTemplateMode($oldMode);

        return $html;
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function renderLinkedin(array $options): Markup
    {
        // Check if service is enabled
        $vars = $this->getSettingsVars();
        if (!$vars['isLinkedinEnabled']) {
            return new Markup('', 'UTF-8');
        }

        // Cast options
        $castedOptions = [
            'counter' => array_key_exists('counter', $options) ? $options['counter'] : null,
            'attributes' => array_key_exists('attributes', $options) ? $options['attributes'] : [],
        ];
        $vars = array_merge($vars, $castedOptions);

        $html = $this->getLinkedinHtml($vars);
        return new Markup($html, 'UTF-8');
    }

    /**
     * @param array $vars
     * @return string
     */
    private function getLinkedinHtml(array $vars)
    {
        Html::addCssClass($vars['attributes'], 'tacLinkedin');
        $html = Html::tag('span', '', $vars['attributes']);

        $scriptAttributes = [];
        $scriptAttributes['type'] = 'IN/Share';
        if (!empty($vars['counter'])) {
            $scriptAttributes['data-counter'] = $vars['counter'];
        }
        $html .= Html::tag('script', '', $scriptAttributes);

        return $html;
    }



    /**
     * @param array $options
     * @return Markup
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function renderTwitter(array $options): Markup
    {
        $vars = $this->getSettingsVars();
        if (!$vars['isTwitterEnabled']) {
            return new Markup('', 'UTF-8');
        }

        $castedOptions = [
            'username' => $options['username'],
            'type' => $options['type'],
            'size' => array_key_exists('size', $options) ? $options['size'] : 'normal',
            'countPosition' => array_key_exists('countPosition', $options) ? $options['countPosition'] : 'null',
        ];
        $vars = array_merge($vars, $castedOptions);

        $html = $this->getTwitterHtml($vars);
        return new Markup($html, 'UTF-8');
    }

    /**
     * @param array $vars
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    private function getTwitterHtml(array $vars)
    {
        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron-js/services/twitter', $vars);
        Craft::$app->getView()->setTemplateMode($oldMode);

        return $html;
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function renderVimeo(array $options): Markup
    {
        $vars = $this->getSettingsVars();
        if (!$vars['isVimeoEnabled']) {
            return new Markup('', 'UTF-8');
        }

        $castedOptions = [
            'videoId' => $options['videoId'],
            'width' => $options['width'],
            'height' => $options['height'],
            'attributes' => array_key_exists('attributes', $options) ? $options['attributes'] : [],
        ];
        $vars = array_merge($vars, $castedOptions);

        $html = $this->getVimeoHtml($vars);
        return new Markup($html, 'UTF-8');
    }

    /**
     * @param array $vars
     * @return string
     */
    private function getVimeoHtml(array $vars) {
        $vars['attributes']['videoID'] = $vars['videoId'];
        $vars['attributes']['width'] = $vars['width'];
        $vars['attributes']['height'] = $vars['height'];
        Html::addCssClass($vars['attributes'], 'vimeo_player');
        return Html::tag('div', '', $vars['attributes']);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function renderYoutube(array $options): Markup
    {
        $vars = $this->getSettingsVars();
        if (!$vars['isYoutubeEnabled']) {
            return new Markup('', 'UTF-8');
        }

        $castedOptions = [
            'videoId' => $options['videoId'],
            'width' => $options['width'],
            'height' => $options['height'],
            'theme' => $options['theme'],
            'rel' => $options['rel'],
            'controls' => $options['controls'],
            'showinfo' => $options['showinfo'],
            'autoplay' => $options['autoplay'],
        ];
        $vars = array_merge($vars, $castedOptions);

        $html = $this->getYoutubeHtml($vars);
        return new Markup($html, 'UTF-8');
    }

    /**
     * @param array $vars
     * @return string
     */
    private function getYoutubeHtml(array $vars) {
        $vars['attributes']['videoID'] = $vars['videoId'];
        $vars['attributes']['width'] = $vars['width'];
        $vars['attributes']['height'] = $vars['height'];
        $vars['attributes']['theme'] = $vars['theme'];
        $vars['attributes']['rel'] = $vars['rel'];
        $vars['attributes']['controls'] = $vars['controls'];
        $vars['attributes']['showinfo'] = $vars['showinfo'];
        $vars['attributes']['autoplay'] = $vars['autoplay'];
        Html::addCssClass($vars['attributes'], 'youtube_player');
        return Html::tag('div', '', $vars['attributes']);
    }
}
