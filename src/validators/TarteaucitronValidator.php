<?php

namespace lhs\tarteaucitron\validators;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\validators\Validator;

/**
 * Class TarteaucitronValidator
 * @package lhs\tarteaucitron\validators
 */
class TarteaucitronValidator extends Validator
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
     * @var ?string
     */
    protected ?string $enablerKey = null;

    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        parent::init();
        if ($this->message === null) {
            $this->message = Yii::t('yii', '{attribute} cannot be blank.');
        }
    }

    /**
     * @param Model $model
     * @param string $attribute
     * @throws NotSupportedException
     */
    public function validateAttribute($model, $attribute): void
    {
        if (!$model->{$this->enablerKey}) {
            return;
        }

        $result = $this->validateValue($model->$attribute);
        if (!empty($result)) {
            $this->addError($model, $attribute, $result[0], $result[1]);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function validateValue($value): ?array
    {
        if ($this->isEmpty($value)) {
            return [$this->message, []];
        }

        return null;
    }
}
