<?php

namespace lhs\tarteaucitron\variables;

use lhs\tarteaucitron\Tarteaucitron as Plugin;
use Twig\Markup;
use yii\base\InvalidConfigException;

/**
 * Class TarteaucitronVariable
 * @package lhs\tarteaucitron\variables
 */
class TarteaucitronVariable
{
    /**
     * @return Markup
     * @noinspection PhpUnused Public API
     */
    public function initScript(): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderInitScript();
    }

    /**
     * @param array $options See [[HTML::tag()]] for details on how options are being used.
     * @return Markup
     * @throws InvalidConfigException
     * @noinspection PhpUnused Public API
     */
    public function javascriptImportTag(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderJavascriptImportTag($options);
    }

    /**
     * @return Markup
     * @noinspection PhpUnused Public API
     */
    public function javascriptConfigTag(): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderJavascriptConfigTag();
    }

    /**
     * @param array $options See [[HTML::tag()]] for details on how options are being used.
     * @return Markup
     * @throws InvalidConfigException
     * @noinspection PhpUnused Public API
     */
    public function stylesheetTag(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderStylesheetTag($options);
    }

    /**
     * @param array $options
     * @return Markup
     * @noinspection PhpUnused Public API
     */
    public function reCAPTCHA(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderReCAPTCHA($options);
    }

    /**
     * @param array $options
     * @return Markup
     * @noinspection PhpUnused Public API
     */
    public function googleMaps(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderGoogleMaps($options);
    }

    /**
     * @param array $options
     * @return Markup
     * @noinspection PhpUnused Public API
     */
    public function googleAdWordsConversion(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderGoogleAdWordsConversion($options);
    }

    /**
     * @param array $options
     * @return Markup
     * @noinspection PhpUnused Public API
     */
    public function linkedin(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderLinkedin($options);
    }

    /**
     * @param array $options
     * @return Markup
     * @noinspection PhpUnused Public API
     */
    public function twitterFollowButton(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderTwitterFollowButton($options);
    }

    /**
     * @param array $options
     * @return Markup
     * @noinspection PhpUnused Public API
     */
    public function twitterShareButton(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderTwitterShareButton($options);
    }

    /**
     * @param array $options
     * @return Markup
     * @noinspection PhpUnused Public API
     */
    public function vimeo(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderVimeo($options);
    }

    /**
     * @param array $options
     * @return Markup
     * @noinspection PhpUnused Public API
     */
    public function youtube(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderYoutube($options);
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isFacebookPixelEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isFacebookPixelEnabled();
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isGoogleTagManagerEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isGoogleTagManagerEnabled();
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isReCAPTCHAEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isReCAPTCHAEnabled();
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isGoogleMapsEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isGoogleMapsEnabled();
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isGoogleAnalyticsUniversalEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isGoogleAnalyticsUniversalEnabled();
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isGoogleAdWordsConversionEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isGoogleAdWordsConversionEnabled();
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isGoogleAdWordsRemarketingEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isGoogleAdWordsRemarketingEnabled();
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isLinkedInEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isLinkedInEnabled();
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isTwitterEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isTwitterEnabled();
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isVimeoEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isVimeoEnabled();
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isYoutubeEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isYoutubeEnabled();
    }

    /**
     * @return bool
     * @noinspection PhpUnused Public API
     */
    public function isYoutubeJsApiEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isYoutubeJsApiEnabled();
    }
}
