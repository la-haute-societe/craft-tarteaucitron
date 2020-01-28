<?php

namespace lhs\tarteaucitron;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;

use lhs\tarteaucitron\bundles\SettingsAsset;
use lhs\tarteaucitron\models\SettingsModel;
use lhs\tarteaucitron\services\TarteaucitronService;
use lhs\tarteaucitron\variables\TarteaucitronVariable;

use yii\base\Event;

/**
 * Class Tarteaucitron
 * @package lhs\tarteaucitron
 * @property TarteaucitronService tarteaucitron
 */
class Tarteaucitron extends Plugin
{
    /**
     * @var bool
     */
    public $hasCpSettings = true;

    /**
     * Initialize plugin.
     */
    public function init()
    {
        parent::init();

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
     * @throws \yii\base\InvalidConfigException Should not happen: if there's a plugin instance, the service should be accessible too.
     */
    public function getTarteaucitron(): TarteaucitronService
    {
        /** @var TarteaucitronService $service */
        $service = $this->get('tarteaucitron');
        return $service;
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): SettingsModel
    {
        return new SettingsModel();
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \yii\base\InvalidConfigException
     */
    protected function settingsHtml(): string
    {
        // Get and pre-validate the settings
        $settings = $this->getSettings();
        $settings->validate();

        // Get the settings that are being defined by the config file
        $overrides = Craft::$app->getConfig()->getConfigFromFile(strtolower($this->handle));

        Craft::$app->view->registerAssetBundle(SettingsAsset::class);
        return Craft::$app->getView()->renderTemplate('tarteaucitron/settings', [
            'settings' => $settings,
            'overrides' => array_keys($overrides),
        ]);
    }
}
