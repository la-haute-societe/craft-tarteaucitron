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
    /** @var boolean Whether the service is enabled */
    public bool $isVimeoEnabled = false;

    /** @var string */
    public string $videoId;

    /** @var string */
    public string $width = 'auto';

    /** @var string */
    public string $height = 'auto';

    /** @var array */
    public array $htmlAttributes = [];


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

        $htmlAttributes = array_merge([
            'data-videoID' => $this->videoId,
            'data-width'   => $this->width,
            'data-height'  => $this->height,
        ], $this->htmlAttributes);
        Html::addCssClass($htmlAttributes, 'vimeo_player');
        $html = Html::tag('div', '', $htmlAttributes);
        return new Markup($html, 'UTF-8');
    }
}
