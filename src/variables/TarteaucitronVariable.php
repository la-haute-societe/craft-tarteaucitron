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
     * @return Markup
     */
    public function googleMaps($zoom, $latitude, $longitude, $width, $height): Markup
    {
        return Plugin::$plugin->tarteaucitron->renderGoogleMaps($zoom, $latitude, $longitude, $width, $height);
    }
}
