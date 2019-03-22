<?php

namespace lahautesociete\tarteaucitron\models\services;

use Craft;
use craft\web\View;

use Twig\Markup;

/**
 * Class Settings
 * @package lahautesociete\tarteaucitron\models
 */

class GoogleAdwordsConversionServiceModel extends ServiceModel
{
    /**
     * @var boolean
     */
    public $isGoogleAdwordsConversionEnabled = false;

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $label;

    /**
     * @var string
     */
    public $language;

    /**
     * @var string
     */
    public $format;

    /**
     * @var string
     */
    public $color;

    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var string
     */
    public $custom1;

    /**
     * @var string
     */
    public $custom2;


    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            // Type validation
            [['isGoogleAdwordsConversionEnabled'], 'boolean'],
            [['id', 'label', 'language', 'format', 'color', 'value', 'currency', 'custom1', 'custom2'], 'string'],
            [['format'], 'integer'],
            [['value'], 'double'],

            // Required attributes
            [['id', 'label'], 'required'],
        ];
    }

    /**
     * @return boolean
     */
    protected function getActivationStatus(): bool
    {
        return $this->isGoogleAdwordsConversionEnabled;
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
        $attributes['id'] = $this->id;
        $attributes['label'] = $this->label;
        $attributes['language'] = $this->language;
        $attributes['format'] = $this->format;
        $attributes['color'] = $this->color;
        $attributes['value'] = $this->value;
        $attributes['currency'] = $this->value;
        $attributes['custom1'] = $this->custom1;
        $attributes['custom2'] = $this->custom2;

        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron-js/services/google-adwords-conversion', $attributes);
        Craft::$app->getView()->setTemplateMode($oldMode);
        return new Markup($html, 'UTF-8');
    }
}