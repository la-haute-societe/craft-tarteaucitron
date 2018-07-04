<?php

namespace lahautesociete\tarteaucitron\services;

use Craft;
use craft\base\Component;
use craft\web\View;

use lahautesociete\tarteaucitron\Tarteaucitron;

/**
 * Class TarteaucitronService
 * @package lahautesociete\tarteaucitron\services
 */
class TarteaucitronService extends Component
{

    /**
     * Renders tarteaucitron dialog script
     *
     * @return string
     *
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function renderInitScript(): string
    {
        $settings = Tarteaucitron::$plugin->getSettings();
        $vars = json_decode(json_encode($settings), true);

        $oldMode = Craft::$app->view->getTemplateMode();
        Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->view->renderTemplate('tarteaucitron/scripts/init', $vars);
        Craft::$app->view->setTemplateMode($oldMode);

        return $html;
    }
}
