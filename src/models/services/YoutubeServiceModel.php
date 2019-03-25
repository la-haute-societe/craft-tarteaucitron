<?php

namespace lahautesociete\tarteaucitron\models\services;

use Twig\Markup;
use yii\helpers\Html;

/**
 * Class YoutubeServiceModel
 * @package lahautesociete\tarteaucitron\models\services
 */
class YoutubeServiceModel extends ServiceModel
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
    public $width;

    /**
     * @var string
     */
    public $height;

    /**
     * @var string
     */
    public $theme;

    /**
     * @var int
     */
    public $rel;

    /**
     * @var int
     */
    public $controls;

    /**
     * @var int
     */
    public $showinfo;

    /**
     * @var int
     */
    public $autoplay;

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
            [['isYoutubeEnabled'], 'boolean'],
            [['videoId', 'width', 'height'], 'string'],
            [['rel', 'controls', 'showinfo', 'autoplay'], 'integer'],
            [['htmlAttributes'], 'craft\validators\ArrayValidator'],

            // Value validation
            ['theme', 'in', 'range' => ['dark', 'light']],
            [['rel', 'controls', 'showinfo', 'autoplay'], 'in', 'range' => [0, 1]],

            // Required attributes
            [['videoId', 'width', 'height', 'rel', 'controls', 'showinfo', 'autoplay'], 'required'],

            // Default values
            [['htmlAttributes'], 'default', 'value' => []],
        ];
    }

    /**
     * @return boolean
     */
    protected function getActivationStatus(): bool
    {
        return $this->isYoutubeEnabled;
    }

    /**
     * @return Markup
     */
    public function getHtml(): Markup {
        if (!$this->getActivationStatus()) {
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