<?php

namespace lahautesociete\tarteaucitron;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;

use lahautesociete\tarteaucitron\models\Settings;
use lahautesociete\tarteaucitron\services\TarteaucitronService;
use lahautesociete\tarteaucitron\variables\TarteaucitronVariable;

use yii\base\Event;

class Tarteaucitron extends Plugin
{
    /**
     * @var Plugin
     */
    public static $plugin;

    /**
     * Initialize plugin.
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function(Event $event) {
            /** @var CraftVariable $variable */
            $variable = $event->sender;
            $variable->set('tarteaucitron', TarteaucitronVariable::class);
        });

        $this->setComponents(['tarteaucitron' => TarteaucitronService::class]);

        Craft::info(
            Craft::t('app', '{name} plugin loaded', [
                'name' => $this->name
            ]),
            __METHOD__
        );
    }


    /**
     * @return TarteaucitronService
     */
    public function getTarteaucitron(): TarteaucitronService
    {
        return $this->get('tarteaucitron');
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    protected function settingsHtml(): string
    {
        // Get and pre-validate the settings
        $settings = $this->getSettings();
        $settings->validate();

        // Get the settings that are being defined by the config file
        $overrides = Craft::$app->getConfig()->getConfigFromFile(strtolower($this->handle));

        return Craft::$app->view->renderTemplate('tarteaucitron/settings', [
            'settings' => $settings,
            'overrides' => array_keys($overrides),
        ]);
    }
}