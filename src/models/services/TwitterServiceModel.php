<?php

namespace lahautesociete\tarteaucitron\models\services;

use Craft;
use craft\web\View;
use Twig\Markup;

/**
 * Class TwitterServiceModel
 * @package lahautesociete\tarteaucitron\models\services
 */
class TwitterServiceModel extends ServiceModel
{
    /**
     * @var boolean
     */
    public $isTwitterEnabled = false;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $size;

    /**
     * @var string
     */
    public $countPosition;


    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            // Type validation
            [['isTwitterEnabled'], 'boolean'],
            [['username', 'type', 'size', 'countPosition'], 'string'],

            // Value validation
            ['type', 'in', 'range' => ['share', 'follow']],
            ['size', 'in', 'range' => ['normal', 'large']],
            ['countPosition', 'in', 'range' => ['vertical', 'horizontal']],

            // Required attributes
            [['username'], 'required'],
        ];
    }

    /**
     * @return boolean
     */
    protected function getActivationStatus(): bool
    {
        return $this->isTwitterEnabled;
    }

    /**
     * @return Markup
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function getHtml(): Markup {
        if (!$this->getActivationStatus()) {
            return new Markup('', 'UTF-8');
        }

        $attributes = [];
        $attributes['username'] = $this->username;
        $attributes['type'] = $this->type;
        $attributes['size'] = $this->size;
        $attributes['countPosition'] = $this->countPosition;

        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron-js/services/twitter', $attributes);
        Craft::$app->getView()->setTemplateMode($oldMode);

        return new Markup($html, 'UTF-8');
    }
}