<?php

namespace lhs\tarteaucitron\models\services;

use Craft;
use craft\validators\ArrayValidator;
use craft\web\View;
use Twig\Markup;

/**
 * Class TwitterServiceModel
 * @package lhs\tarteaucitron\models\services
 */
class TwitterFollowButtonServiceModel extends AbstractServiceModel
{
    /** @var boolean */
    public $isTwitterEnabled = false;

    /** @var string The name of the user to follow if type is "follow". */
    public $username;

    /** @var bool A boolean indicating whether to display the large version of the button. */
    public $isLarge = false;

    /** @var bool A boolean indicating whether to display the follower count. */
    public $showCount = true;

    /** @var bool A boolean indicating whether to display the screen name. */
    public $showScreenName = true;

    /** @var string Force the button language. Must be a set to a supported Twitter language code. */
    public $lang;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            // Type validation
            [['isTwitterEnabled', 'showScreenName', 'showCount', 'isLarge'], 'boolean'],
            [['username', 'lang'], 'string'],

            // Required attributes
            [['username', ], 'required'],
        ];
    }

    /**
     * @return boolean
     */
    public function isServiceEnabled(): bool
    {
        return $this->isTwitterEnabled;
    }

    /**
     * @return Markup
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function getHtml(): Markup {
        if (!$this->isServiceEnabled()) {
            return new Markup('', 'UTF-8');
        }

        $oldMode = Craft::$app->getView()->getTemplateMode();
        Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron/services/twitter-follow-button', [
            'username'       => $this->username,
            'size'           => $this->isLarge ? 'large' : 'normal',
            'showCount'      => $this->showCount,
            'lang'           => $this->lang,
            'showScreenName' => $this->showScreenName,
        ]);
        Craft::$app->getView()->setTemplateMode($oldMode);

        return new Markup($html, 'UTF-8');
    }
}
