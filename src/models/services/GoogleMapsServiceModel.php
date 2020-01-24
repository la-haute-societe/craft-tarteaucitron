<?php

namespace lhs\tarteaucitron\models\services;

use Twig\Markup;
use yii\helpers\Html;

/**
 * Class GoogleMapsServiceModel
 * @package lhs\tarteaucitron\models\services
 */
class GoogleMapsServiceModel extends AbstractServiceModel
{
    /**
     * @var boolean
     */
    public $isGoogleMapsEnabled = false;

    /**
     * @var string
     */
    public $googleMapsAPIKey;

    /**
     * @var int
     */
    public $zoom;

    /**
     * @var double
     */
    public $latitude;

    /**
     * @var double
     */
    public $longitude;

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
     * @return array
     */
    public function rules(): array
    {
        return [
            // Type validation
            [['isGoogleMapsEnabled'], 'boolean'],
            [['googleMapsAPIKey', 'width', 'height'], 'string'],
            [['zoom'], 'integer'],
            [['latitude', 'longitude'], 'double'],
            [['htmlAttributes'], 'craft\validators\ArrayValidator'],

            // Required attributes
            [['googleMapsAPIKey', 'zoom', 'latitude', 'longitude', 'width', 'height'], 'required'],

            // Default values
            [['htmlAttributes'], 'default', 'value' => []],
        ];
    }

    /**
     * @return boolean
     */
    public function isServiceEnabled(): bool
    {
        return $this->isGoogleMapsEnabled;
    }

    /**
     * @return Markup
     */
    public function getHtml(): Markup {
        if (!$this->isServiceEnabled()) {
            return new Markup('', 'UTF-8');
        }

        $this->htmlAttributes['zoom'] = $this->zoom;
        $this->htmlAttributes['latitude'] = $this->latitude;
        $this->htmlAttributes['longitude'] = $this->longitude;
        Html::addCssStyle($this->htmlAttributes, sprintf('width: %s; height: %s;', $this->width, $this->height));
        Html::addCssClass($this->htmlAttributes, 'googlemaps-canvas');
        $html = Html::tag('div', '', $this->htmlAttributes);
        return new Markup($html, 'UTF-8');
    }
}
