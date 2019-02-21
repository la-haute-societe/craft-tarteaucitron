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
}
