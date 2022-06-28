<?php

namespace lhs\tarteaucitron\models\services;

use Craft;
use craft\web\View;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Markup;
use yii\base\Exception;

/**
 * Class GoogleAdWordsConversionServiceModel
 * @package lhs\tarteaucitron\models\services
 */
class GoogleAdWordsConversionServiceModel extends AbstractServiceModel
{
    /** @var bool Whether the service is enabled */
    public bool $isGoogleAdWordsConversionEnabled = false;

    /** @var string */
    public string $id;

    /** @var string */
    public string $label;

    /** @var string */
    public string $language;

    /** @var string */
    public string $format;

    /** @var string */
    public string $color;

    /** @var string */
    public string $value;

    /** @var string */
    public string $currency;

    /** @var string */
    public string $custom1;

    /** @var string */
    public string $custom2;


    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            // Type validation
            [['isGoogleAdWordsConversionEnabled'], 'boolean'],
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
    public function isServiceEnabled(): bool
    {
        return $this->isGoogleAdWordsConversionEnabled;
    }

    /**
     * @return Markup
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws Exception
     */
    public function getHtml(): Markup {
        if (!$this->isServiceEnabled()) {
            return new Markup('', 'UTF-8');
        }

        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron/services/google-adWords-conversion', [
            'id' => $this->id,
            'label' => $this->label,
            'language' => $this->language,
            'format' => $this->format,
            'color' => $this->color,
            'value' => $this->value,
            'currency' => $this->value,
            'custom1' => $this->custom1,
            'custom2' => $this->custom2,
        ]);
        Craft::$app->getView()->setTemplateMode($oldMode);

        return new Markup($html, 'UTF-8');
    }
}
