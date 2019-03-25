<?php

namespace lahautesociete\tarteaucitron\models\services;

use Twig\Markup;
use yii\helpers\Html;

/**
 * Class VimeoServiceModel
 * @package lahautesociete\tarteaucitron\models\services
 */
class VimeoServiceModel extends ServiceModel
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
    public $width;

    /**
     * @var string
     */
    public $height;

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
            [['isVimeoEnabled'], 'boolean'],
            [['videoId', 'width', 'height'], 'string'],
            [['htmlAttributes'], 'craft\validators\ArrayValidator'],

            // Required attributes
            [['videoId', 'width', 'height'], 'required'],

            // Default values
            [['htmlAttributes'], 'default', 'value' => []],
        ];
    }

    /**
     * @return boolean
     */
    protected function getActivationStatus(): bool
    {
        return $this->isVimeoEnabled;
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
        Html::addCssClass($this->htmlAttributes, 'vimeo_player');
        $html = Html::tag('div', '', $this->htmlAttributes);
        return new Markup($html, 'UTF-8');
    }
}