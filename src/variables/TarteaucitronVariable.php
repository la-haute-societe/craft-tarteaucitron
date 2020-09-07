<?php

namespace lhs\tarteaucitron\variables;

use lhs\tarteaucitron\Tarteaucitron as Plugin;
use Twig\Markup;

/**
 * Class TarteaucitronVariable
 * @package lhs\tarteaucitron\variables
 */
class TarteaucitronVariable
{
    /**
     * @return Markup
     */
    public function initScript(): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderInitScript();
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function reCAPTCHA(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderReCAPTCHA($options);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function googleMaps(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderGoogleMaps($options);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function googleAdWordsConversion(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderGoogleAdWordsConversion($options);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function linkedin(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderLinkedin($options);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function twitterFollowButton(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderTwitterFollowButton($options);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function twitterShareButton(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderTwitterShareButton($options);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function vimeo(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderVimeo($options);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function youtube(array $options = []): Markup
    {
        return Plugin::getInstance()->tarteaucitron->renderYoutube($options);
    }

    public function isFacebookPixelEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isFacebookPixelEnabled();
    }

    public function isGoogleTagManagerEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isGoogleTagManagerEnabled();
    }

    public function isReCAPTCHAEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isReCAPTCHAEnabled();
    }

    public function isGoogleMapsEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isGoogleMapsEnabled();
    }

    public function isGoogleAnalyticsUniversalEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isGoogleAnalyticsUniversalEnabled();
    }

    public function isGoogleAdWordsConversionEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isGoogleAdWordsConversionEnabled();
    }

    public function isGoogleAdWordsRemarketingEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isGoogleAdWordsRemarketingEnabled();
    }

    public function isLinkedInEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isLinkedInEnabled();
    }

    public function isTwitterEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isTwitterEnabled();
    }

    public function isVimeoEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isVimeoEnabled();
    }

    public function isYoutubeEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isYoutubeEnabled();
    }

    public function isYoutubeJsApiEnabled(): bool
    {
        return Plugin::getInstance()->tarteaucitron->isYoutubeJsApiEnabled();
    }
}
