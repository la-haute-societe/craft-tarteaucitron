<?php

namespace lahautesociete\tarteaucitron\models\services;

use Twig\Markup;
use yii\helpers\Html;

/**
 * Class ReCAPTCHAServiceModel
 * @package lahautesociete\tarteaucitron\models\services
 */
class ReCAPTCHAServiceModel extends ServiceModel
{
    /**
     * @var boolean
     */
    public $isReCAPTCHAEnabled = false;

    /**
     * @var string
     */
    public $reCAPTCHASiteKey;

    /**
     * @var array
     */
    public $htmlAttributes;


    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            // Type validation
            [['isReCAPTCHAEnabled'], 'boolean'],
            [['reCAPTCHASiteKey'], 'string'],
            [['htmlAttributes'], 'craft\validators\ArrayValidator'],

            // Required attributes
            [['reCAPTCHASiteKey'], 'required'],

            // Default values
            [['htmlAttributes'], 'default', 'value' => []],
        ];
    }

    /**
     * @return boolean
     */
    protected function getActivationStatus(): bool
    {
        return $this->isReCAPTCHAEnabled;
    }

    /**
     * @return Markup
     */
    public function getHtml(): Markup {
        if (!$this->getActivationStatus()) {
            return new Markup('', 'UTF-8');
        }

        $this->htmlAttributes['data-sitekey'] = $this->reCAPTCHASiteKey;
        Html::addCssClass($this->htmlAttributes, 'g-recaptcha');
        $html = Html::tag('div', '', $this->htmlAttributes);
        return new Markup($html, 'UTF-8');
    }
}