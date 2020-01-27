<?php

namespace lhs\tarteaucitron\models\services;

use Twig\Markup;
use yii\helpers\Html;

/**
 * Class LinkedinServiceModel
 * @package lhs\tarteaucitron\models\services
 */
class LinkedInServiceModel extends AbstractServiceModel
{
    /**
     * @var boolean
     */
    public $isLinkedInEnabled = false;

    /**
     * @var string
     */
    public $counter;

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
            [['isLinkedInEnabled'], 'boolean'],
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
    public function isServiceEnabled(): bool
    {
        return $this->isLinkedInEnabled;
    }

    /**
     * @return Markup
     */
    public function getHtml(): Markup {
        if (!$this->isServiceEnabled()) {
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
