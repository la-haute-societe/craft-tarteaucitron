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
