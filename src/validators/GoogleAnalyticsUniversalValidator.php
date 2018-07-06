<?php

namespace lahautesociete\tarteaucitron\validators;

use Yii;
use yii\validators\Validator;

/**
 * Class GoogleTagManagerValidator
 * @package lahautesociete\tarteaucitron\validators
 */
class GoogleAnalyticsUniversalValidator extends Validator
{
    /**
     * @var bool whether to skip this validator if the value being validated is empty.
     */
    public $skipOnEmpty = false;

    /**
     * @var string the user-defined error message. It may contain the following placeholders which
     * will be replaced accordingly by the validator:
     *
     * - `{attribute}`: the label of the attribute being validated
     * - `{value}`: the value of the attribute being validated
     */
    public $message;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = Yii::t('yii', '{attribute} cannot be blank.');
        }
    }

    /**
     * @param \yii\base\Model $model
     * @param string $attribute
     * @throws \yii\base\NotSupportedException
     */
    public function validateAttribute($model, $attribute)
    {
        if (!$model->isGoogleAnalyticsUniversalEnabled)
            return;

        $result = $this->validateValue($model->$attribute);
        if (!empty($result)) {
            $this->addError($model, $attribute, $result[0], $result[1]);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function validateValue($value)
    {
        if ($this->isEmpty($value)) {
            return [$this->message, []];
        }

        return null;
    }
}
