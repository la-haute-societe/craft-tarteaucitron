<?php

namespace lhs\tarteaucitron\models\services;

use Twig\Markup;
use yii\helpers\Html;
use craft\validators\ArrayValidator;

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

    /** @var string[] */
    public $googleMapsLibraries = [];

    /** @var string */
    public $googleMapsCallbackName;

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
    public $htmlAttributes = [];


    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            // Type validation
            [['isGoogleMapsEnabled'], 'boolean'],
            [['googleMapsAPIKey', 'googleMapsCallbackName', 'width', 'height'], 'string'],
            [['zoom'], 'integer'],
            [['latitude', 'longitude'], 'double'],
            [['htmlAttributes', 'googleMapsLibraries'], ArrayValidator::class],

            // Required attributes
            [['googleMapsAPIKey', 'zoom', 'latitude', 'longitude', 'width', 'height'], 'required'],
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

        $htmlAttributes = array_merge([
            'zoom'      => $this->zoom,
            'latitude'  => $this->latitude,
            'longitude' => $this->longitude,
        ], $this->htmlAttributes);
        Html::addCssStyle($htmlAttributes, sprintf('width: %s; height: %s;', $this->width, $this->height));
        Html::addCssClass($htmlAttributes, 'googlemaps-canvas');
        $html = Html::tag('div', '', $htmlAttributes);
        return new Markup($html, 'UTF-8');
    }
}
