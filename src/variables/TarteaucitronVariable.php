<?php

namespace lahautesociete\tarteaucitron\variables;

use lahautesociete\tarteaucitron\Tarteaucitron as Plugin;
use Twig\Markup;

/**
 * Class TarteaucitronVariable
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
     * @return Markup
     */
    public function reCAPTCHA(): Markup
    {
        return Plugin::$plugin->tarteaucitron->renderReCAPTCHA();
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function googleMaps(array $options): Markup
    {
        return Plugin::$plugin->tarteaucitron->renderGoogleMaps($options);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function googleAdwordsConversion(array $options): Markup
    {
        return Plugin::$plugin->tarteaucitron->renderGoogleAdwordsConversion($options);
    }

    /**
     * @param array $options
     * @return Markup
     */
    public function linkedin(array $options): Markup
    {
        return Plugin::$plugin->tarteaucitron->renderLinkedin($options);
    }
}
