<?php

namespace lahautesociete\tarteaucitron\variables;

use lahautesociete\tarteaucitron\Tarteaucitron as Plugin;

/**
 * Class TarteaucitronVariable
 * @package humandirect\cookiebot\variables
 */
class TarteaucitronVariable
{
    /**
     * @return string
     */
    public function initScript(): string
    {
        return Plugin::$plugin->tarteaucitron->renderInitScript();
    }
}
