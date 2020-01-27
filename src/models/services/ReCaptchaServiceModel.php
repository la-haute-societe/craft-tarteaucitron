<?php

namespace lhs\tarteaucitron\models\services;

use Twig\Markup;
use yii\helpers\Html;
use craft\validators\ArrayValidator;

/**
 * Class ReCAPTCHAServiceModel
 * @package lhs\tarteaucitron\models\services
 */
class ReCaptchaServiceModel extends AbstractServiceModel
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
    public $htmlAttributes = [];


    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            // Type validation
            [['isReCAPTCHAEnabled'], 'boolean'],
            [['reCAPTCHASiteKey'], 'string'],
            [['htmlAttributes'], ArrayValidator::class],

            // Required attributes
            [['reCAPTCHASiteKey'], 'required'],
        ];
    }

    /**
     * @return boolean
     */
    public function isServiceEnabled(): bool
    {
        return $this->isReCAPTCHAEnabled;
    }

    /**
     * @return Markup
     */
    public function getHtml(): Markup {
        if (!$this->isServiceEnabled()) {
            return new Markup('', 'UTF-8');
        }

        $this->htmlAttributes['data-sitekey'] = $this->reCAPTCHASiteKey;
        Html::addCssClass($this->htmlAttributes, 'g-recaptcha');
        $html = Html::tag('div', '', $this->htmlAttributes);
        return new Markup($html, 'UTF-8');
    }
}
