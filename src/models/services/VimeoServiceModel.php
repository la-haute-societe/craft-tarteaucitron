<?php

namespace lhs\tarteaucitron\models\services;

use Twig\Markup;
use yii\helpers\Html;
use craft\validators\ArrayValidator;

/**
 * Class VimeoServiceModel
 * @package lhs\tarteaucitron\models\services
 */
class VimeoServiceModel extends AbstractServiceModel
{
    /**
     * @var boolean
     */
    public $isVimeoEnabled = false;

    /**
     * @var string
     */
    public $videoId;

    /**
     * @var string
     */
    public $width = 'auto';

    /**
     * @var string
     */
    public $height = 'auto';

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
            [['isVimeoEnabled'], 'boolean'],
            [['videoId', 'width', 'height'], 'string'],
            [['htmlAttributes'], ArrayValidator::class],

            // Required attributes
            [['videoId'], 'required'],
        ];
    }

    /**
     * @return boolean
     */
    public function isServiceEnabled(): bool
    {
        return $this->isVimeoEnabled;
    }

    /**
     * @return Markup
     */
    public function getHtml(): Markup {
        if (!$this->isServiceEnabled()) {
            return new Markup('', 'UTF-8');
        }

        $this->htmlAttributes['videoID'] = $this->videoId;
        $this->htmlAttributes['width'] = $this->width;
        $this->htmlAttributes['height'] = $this->height;
        Html::addCssClass($this->htmlAttributes, 'vimeo_player');
        $html = Html::tag('div', '', $this->htmlAttributes);
        return new Markup($html, 'UTF-8');
    }
}
