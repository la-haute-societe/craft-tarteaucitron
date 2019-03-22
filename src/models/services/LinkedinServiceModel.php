<?php

namespace lahautesociete\tarteaucitron\models\services;

use Twig\Markup;
use yii\helpers\Html;

/**
 * Class Settings
 * @package lahautesociete\tarteaucitron\models
 */

class LinkedinServiceModel extends ServiceModel
{
    /**
     * @var boolean
     */
    public $isLinkedinEnabled = false;

    /**
     * @var string
     */
    public $counter;

    /**
     * @var array
     */
    public $htmlAttributes;

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            // Type validation
            [['isLinkedinEnabled'], 'boolean'],
            [['counter'], 'string'],
            [['htmlAttributes'], 'craft\validators\ArrayValidator'],

            // Value validation
            ['counter', 'in', 'range' => ['top', 'right']],

            // Default values
            [['htmlAttributes'], 'default', 'value' => []],
        ];
    }

    /**
     * @return boolean
     */
    protected function getActivationStatus(): bool
    {
        return $this->isLinkedinEnabled;
    }

    /**
     * @return Markup
     */
    public function getHtml(): Markup {
        if (!$this->getActivationStatus()) {
            return new Markup('', 'UTF-8');
        }

        Html::addCssClass($this->htmlAttributes, 'tacLinkedin');
        $html = Html::tag('span', '', $this->htmlAttributes);

        $scriptAttributes = [];
        $scriptAttributes['type'] = 'IN/Share';
        if (!empty($this->counter)) {
            $scriptAttributes['data-counter'] = $this->counter;
        }
        $html .= Html::tag('script', '', $scriptAttributes);

        return new Markup($html, 'UTF-8');
    }
}