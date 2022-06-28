<?php

namespace lhs\tarteaucitron;

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;

use lhs\tarteaucitron\bundles\SettingsAsset;
use lhs\tarteaucitron\models\SettingsModel;
use lhs\tarteaucitron\services\TarteaucitronService;
use lhs\tarteaucitron\variables\TarteaucitronVariable;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use yii\base\Event;
use yii\base\Exception;
use yii\base\InvalidConfigException;

/**
 * Class Tarteaucitron
 *
 * @package lhs\tarteaucitron
 * @property TarteaucitronService $tarteaucitron
 * @method static Tarteaucitron getInstance()
 * @method SettingsModel getSettings()
 */
class Tarteaucitron extends Plugin
{
    /**
     * @var bool
     */
    public bool $hasCpSettings = true;

    /**
     * Initialize plugin.
     */
    public function init()
    {
        parent::init();

        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, static function(Event $event) {
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
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws Exception
     * @throws InvalidConfigException
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
