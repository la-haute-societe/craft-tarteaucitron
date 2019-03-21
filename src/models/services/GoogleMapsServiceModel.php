<?php

namespace lahautesociete\tarteaucitron\models\services;

use Twig\Markup;
use yii\helpers\Html;

/**
 * Class Settings
 * @package lahautesociete\tarteaucitron\models
 */

class GoogleMapsServiceModel extends ServiceModel
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
     * @inheritdoc
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
            [['isGoogleMapsEnabled', 'googleMapsAPIKey', 'zoom', 'latitude', 'longitude', 'width', 'height'], 'required'],

            // Default values
            [['htmlAttributes'], 'default', 'value' => []],
        ];
    }

    /**
     * @return boolean
     */
    protected function getActivationStatus(): bool
    {
        return $this->isGoogleMapsEnabled;
    }

    /**
     * @return Markup
     */
    public function getHtml(): Markup {
        if (!$this->getActivationStatus()) {
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