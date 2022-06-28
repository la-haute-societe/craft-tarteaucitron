<?php

namespace lhs\tarteaucitron\services;

use Craft;
use craft\base\Component;
use craft\web\View;

use lhs\tarteaucitron\bundles\FrontAsset;
use lhs\tarteaucitron\models\services\AbstractServiceModel;
use lhs\tarteaucitron\models\services\GoogleAdWordsConversionServiceModel;
use lhs\tarteaucitron\models\services\GoogleMapsServiceModel;
use lhs\tarteaucitron\models\services\LinkedInServiceModel;
use lhs\tarteaucitron\models\services\ReCaptchaServiceModel;
use lhs\tarteaucitron\models\services\TwitterShareButtonServiceModel;
use lhs\tarteaucitron\models\services\TwitterFollowButtonServiceModel;
use lhs\tarteaucitron\models\services\VimeoServiceModel;
use lhs\tarteaucitron\models\services\YouTubeServiceModel;
use lhs\tarteaucitron\Tarteaucitron;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Markup;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\helpers\Html;

/**
 * Class TarteaucitronService
 * @package lhs\tarteaucitron\services
 */
class TarteaucitronService extends Component
{
    /**
     * Call tarteaucitron init script
     * @return Markup
     * @throws Exception
     * @throws InvalidConfigException
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function renderInitScript(): Markup
    {
        return new Markup($this->renderJavascriptImportTag() . $this->renderJavascriptConfigTag(), 'UTF-8');
    }

    /**
     * Render tarteaucitron main JS tag
     *
     * @param array $options See [[HTML::tag()]] for details on how options are being used.
     * @return Markup
     * @throws InvalidConfigException
     */
    public function renderJavascriptImportTag(array $options = []): Markup
    {
        $assetBundle = Craft::$app->getView()->registerAssetBundle(FrontAsset::class);
        $options = array_merge(['src' => $assetBundle->baseUrl . '/tarteaucitron.js' ], $options);

        return new Markup(Html::tag('script', null, $options), 'UTF-8');
    }

    /**
     * Render tarteaucitron config JS tag
     *
     * @return Markup
     * @throws Exception
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function renderJavascriptConfigTag(): Markup
    {
        $settings = Tarteaucitron::getInstance()->getSettings();
        $html = $this->getInitHtml([ 'settings' => $settings ]);

        return new Markup($html, 'UTF-8');
    }

    /**
     * Render tarteaucitron stylesheet tag
     *
     * @param array $options See [[HTML::tag()]] for details on how options are being used.
     * @return Markup
     * @throws InvalidConfigException
     */
    public function renderStylesheetTag(array $options = []): Markup
    {
        $assetBundle = Craft::$app->getView()->registerAssetBundle(FrontAsset::class);
        $options = array_merge([
            'rel' => 'stylesheet',
            'href' => $assetBundle->baseUrl . '/css/tarteaucitron.css',
        ], $options);

        return new Markup(Html::tag('link', null, $options), 'UTF-8');
    }

    /**
     *
     * @param array $vars
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws Exception
     */
    private function getInitHtml(array $vars): string
    {
        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron/init', $vars);
        Craft::$app->getView()->setTemplateMode($oldMode);
        return $html;
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isFacebookPixelEnabled(): bool
    {
        return (bool)Tarteaucitron::getInstance()->getSettings()->isFacebookPixelEnabled;
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isFacilitiEnabled(): bool
    {
        return (bool)Tarteaucitron::getInstance()->getSettings()->isFacilitiEnabled;
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isGoogleTagManagerEnabled(): bool
    {
        return (bool)Tarteaucitron::getInstance()->getSettings()->isGoogleTagManagerEnabled;
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isGoogleAnalyticsUniversalEnabled(): bool
    {
        return (bool)Tarteaucitron::getInstance()->getSettings()->isGoogleAnalyticsUniversalEnabled;
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isGoogleAdWordsRemarketingEnabled(): bool
    {
        return (bool)Tarteaucitron::getInstance()->getSettings()->isGoogleAdWordsRemarketingEnabled;
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isYoutubeJsApiEnabled(): bool
    {
        return (bool)Tarteaucitron::getInstance()->getSettings()->isYoutubeJsApiEnabled;
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isReCAPTCHAEnabled(): bool
    {
        return (bool)Tarteaucitron::getInstance()->getSettings()->isReCAPTCHAEnabled;
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function renderReCAPTCHA(array $options): Markup
    {
        return $this->renderService(ReCaptchaServiceModel::class, $options);
    }


    public function isGoogleMapsEnabled(): bool
    {
        return (bool)Tarteaucitron::getInstance()->getSettings()->isGoogleMapsEnabled;
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function renderGoogleMaps(array $options): Markup
    {
        return $this->renderService(GoogleMapsServiceModel::class, $options);
    }


    public function isGoogleAdWordsConversionEnabled(): bool
    {
        return (bool)Tarteaucitron::getInstance()->getSettings()->isGoogleAdWordsConversionEnabled;
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function renderGoogleAdWordsConversion(array $options): Markup
    {
        return $this->renderService(GoogleAdWordsConversionServiceModel::class, $options);
    }


    public function isLinkedInEnabled(): bool
    {
        return (bool)Tarteaucitron::getInstance()->getSettings()->isLinkedInEnabled;
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function renderLinkedin(array $options): Markup
    {
        return $this->renderService(LinkedInServiceModel::class, $options);
    }


    public function isTwitterEnabled(): bool
    {
        return (bool)Tarteaucitron::getInstance()->getSettings()->isTwitterEnabled;
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function renderTwitterShareButton(array $options): Markup
    {
        return $this->renderService(TwitterShareButtonServiceModel::class, $options);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function renderTwitterFollowButton(array $options): Markup
    {
        return $this->renderService(TwitterFollowButtonServiceModel::class, $options);
    }


    public function isVimeoEnabled(): bool
    {
        return (bool)Tarteaucitron::getInstance()->getSettings()->isVimeoEnabled;
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function renderVimeo(array $options): Markup
    {
        return $this->renderService(VimeoServiceModel::class, $options);
    }


    public function isYoutubeEnabled(): bool
    {
        return (bool)Tarteaucitron::getInstance()->getSettings()->isYoutubeEnabled;
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function renderYoutube(array $options): Markup
    {
        return $this->renderService(YouTubeServiceModel::class, $options);
    }


    protected function renderService(string $serviceModelClassName, array $options): Markup
    {
        if (!class_exists($serviceModelClassName)) {
            return AbstractServiceModel::getErrorHtml(sprintf(
                'Class %s does not exist',
                $serviceModelClassName
            ), 'Service model class not found.');
        }

        $settingsArray = get_object_vars(Tarteaucitron::getInstance()->getSettings());
        $vars = array_merge($settingsArray, $options);

        /** @var AbstractServiceModel $model */
        $model = new $serviceModelClassName();
        $model->setAttributes($vars);

        if (!$model instanceof AbstractServiceModel) {
            return AbstractServiceModel::getErrorHtml(sprintf(
                'ServiceModel classes must extend %s. %s does not.',
                AbstractServiceModel::class,
                $serviceModelClassName
            ), 'Service model class doesn\'t extend AbstractServiceModel.');
        }

        if (!$model->validate()) {
            return AbstractServiceModel::getErrorHtml(Html::errorSummary($model), 'Service model validation failed.');
        }

        if (!$model->isServiceEnabled()) {
            return AbstractServiceModel::getErrorHtml(
                'This service is disabled. Enable it in the craft-tarteaucitron plugin settings.',
                'Trying to render a disabled service.'
            );
        }

        return $model->getHtml();
    }
}
