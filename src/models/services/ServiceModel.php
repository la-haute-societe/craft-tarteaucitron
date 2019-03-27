<?php

namespace lhs\tarteaucitron\models\services;

use craft\base\Model;
use Exception;
use Twig\Markup;

/**
 * Class ServiceModel
 * @package lhs\tarteaucitron\models\services
 */
abstract class ServiceModel extends Model
{

    /**
     * Return activation status
     * Preferably based on an model attribute
     *
     * @return boolean
     */
    abstract protected function getActivationStatus(): bool;

    /**
     * Return html for front rendering
     *
     * @return Markup
     */
    abstract public function getHtml(): Markup;

    /**
     * Do model validation and throw exceptions if there is errors
     *
     * @param null $attributeNames
     * @param bool $clearErrors
     * @return bool|void
     * @throws Exception
     */
    public function validateAndThrowErrors($attributeNames = null, $clearErrors = true)
    {
        if (!parent::validate($attributeNames, $clearErrors)) {
            foreach ($this->getErrors() as $error) {
                throw new Exception($error[0]);
            }
        };
    }
}