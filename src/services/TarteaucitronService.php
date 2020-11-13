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
use Twig\Markup;
use yii\helpers\Html;

/**
 * Class TarteaucitronService
 * @package lhs\tarteaucitron\services
 */
class TarteaucitronService extends Component
{
    /**
     * Call tarteaucitron init script
     *
     * @return Markup
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function renderInitScript(): Markup
    {
        Craft::$app->getView()->registerAssetBundle(FrontAsset::class);

        /** @noinspection NullPointerExceptionInspection */
        $settings = Tarteaucitron::getInstance()->getSettings();
        $html = $this->getInitHtml([ 'settings' => $settings ]);

        return new Markup($html, 'UTF-8');
    }

    /**
     *
     * @param array $vars
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \yii\base\Exception
     */
    private function getInitHtml(array $vars)
    {
        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron/init', $vars);
        Craft::$app->getView()->setTemplateMode($oldMode);
        return $html;
    }


    public function isFacebookPixelEnabled(): bool
    {
        /** @noinspection NullPointerExceptionInspection */
        return (bool)Tarteaucitron::getInstance()->getSettings()->isFacebookPixelEnabled;
    }

    public function isGoogleTagManagerEnabled(): bool
    {
        /** @noinspection NullPointerExceptionInspection */
        return (bool)Tarteaucitron::getInstance()->getSettings()->isGoogleTagManagerEnabled;
    }

    public function isGoogleAnalyticsUniversalEnabled(): bool
    {
        /** @noinspection NullPointerExceptionInspection */
        return (bool)Tarteaucitron::getInstance()->getSettings()->isGoogleAnalyticsUniversalEnabled;
    }

    public function isGoogleAdWordsRemarketingEnabled(): bool
    {
        /** @noinspection NullPointerExceptionInspection */
        return (bool)Tarteaucitron::getInstance()->getSettings()->isGoogleAdWordsRemarketingEnabled;
    }

    public function isYoutubeJsApiEnabled(): bool
    {
        /** @noinspection NullPointerExceptionInspection */
        return (bool)Tarteaucitron::getInstance()->getSettings()->isYoutubeJsApiEnabled;
    }


    public function isReCAPTCHAEnabled(): bool
    {
        /** @noinspection NullPointerExceptionInspection */
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
        /** @noinspection NullPointerExceptionInspection */
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
        /** @noinspection NullPointerExceptionInspection */
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
        /** @noinspection NullPointerExceptionInspection */
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
        /** @noinspection NullPointerExceptionInspection */
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
        /** @noinspection NullPointerExceptionInspection */
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
        /** @noinspection NullPointerExceptionInspection */
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

        /** @noinspection NullPointerExceptionInspection */
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
