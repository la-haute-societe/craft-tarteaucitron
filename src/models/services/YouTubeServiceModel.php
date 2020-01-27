<?php

namespace lhs\tarteaucitron\models\services;

use Twig\Markup;
use yii\helpers\Html;
use craft\validators\ArrayValidator;

/**
 * Class YoutubeServiceModel
 * @package lhs\tarteaucitron\models\services
 */
class YouTubeServiceModel extends AbstractServiceModel
{
    /**
     * @var boolean
     */
    public $isYoutubeEnabled = false;

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
     * @var string
     */
    public $theme = 'dark';

    /**
     * @var int
     */
    public $rel = 0;

    /**
     * @var int
     */
    public $controls = 1;

    /**
     * @var int
     */
    public $showinfo = 1;

    /**
     * @var int
     */
    public $autoplay = 0;

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
            [['isYoutubeEnabled'], 'boolean'],
            [['videoId', 'width', 'height'], 'string'],
            [['rel', 'controls', 'showinfo', 'autoplay'], 'integer'],
            [['htmlAttributes'], ArrayValidator::class],

            // Value validation
            ['theme', 'in', 'range' => ['dark', 'light']],
            [['rel', 'controls', 'showinfo', 'autoplay'], 'in', 'range' => [0, 1]],

            // Required attributes
            [['videoId'], 'required'],
        ];
    }

    /**
     * @return boolean
     */
    public function isServiceEnabled(): bool
    {
        return $this->isYoutubeEnabled;
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
        $this->htmlAttributes['theme'] = $this->theme;
        $this->htmlAttributes['rel'] = $this->rel;
        $this->htmlAttributes['controls'] = $this->controls;
        $this->htmlAttributes['showinfo'] = $this->showinfo;
        $this->htmlAttributes['autoplay'] = $this->autoplay;
        Html::addCssClass($this->htmlAttributes, 'youtube_player');
        $html = Html::tag('div', '', $this->htmlAttributes);
        return new Markup($html, 'UTF-8');
    }
}
