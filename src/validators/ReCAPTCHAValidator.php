<?php

namespace lahautesociete\tarteaucitron\validators;

use Yii;
use yii\validators\Validator;

/**
 * Class ReCAPTCHAValidator
 * @package lahautesociete\tarteaucitron\validators
 */
class ReCAPTCHAValidator extends TarteaucitronValidator
{
    protected $enablerKey = "isReCAPTCHAEnabled";
}
