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
        return Plugin::$plugin->tarteaucitron->renderInitScript();
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function reCAPTCHA(array $options = []): Markup
    {
        return Plugin::$plugin->tarteaucitron->renderReCAPTCHA($options);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function googleMaps(array $options = []): Markup
    {
        return Plugin::$plugin->tarteaucitron->renderGoogleMaps($options);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function googleAdwordsConversion(array $options = []): Markup
    {
        return Plugin::$plugin->tarteaucitron->renderGoogleAdwordsConversion($options);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function linkedin(array $options = []): Markup
    {
        return Plugin::$plugin->tarteaucitron->renderLinkedin($options);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function twitter(array $options = []): Markup
    {
        return Plugin::$plugin->tarteaucitron->renderTwitter($options);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function vimeo(array $options = []): Markup
    {
        return Plugin::$plugin->tarteaucitron->renderVimeo($options);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function youtube(array $options = []): Markup
    {
        return Plugin::$plugin->tarteaucitron->renderYoutube($options);
    }
}
