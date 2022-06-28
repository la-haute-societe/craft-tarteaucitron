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
class TwitterShareButtonServiceModel extends AbstractServiceModel
{
    /** @var boolean Whether the service is enabled */
    public bool $isTwitterEnabled = false;

    /** @var string Attribute the source of a Tweet to a Twitter username. */
    public string $via;

    /** @var bool A boolean indicating whether to display the large version of the button. */
    public bool $isLarge = false;

    /** @var string Pre-populated text highlighted in the Tweet composer. */
    public string $text;

    /** @var string URL included with the Tweet. */
    public string $url;

    /** @var string A comma-separated list of hashtags to be appended to default Tweet text. */
    public string $hashtags;

    /** @var string A comma-separated list of accounts related to the content of the shared URI. */
    public string $related;

    /** @var string Force the button language. Must be a set to a supported Twitter language code. */
    public string $lang;




    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            // Type validation
            [['isTwitterEnabled', 'isLarge'], 'boolean'],
            [['via', 'text', 'hashtags', 'related', 'lang'], 'string'],
            [['url'], 'url'],
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
        $html = Craft::$app->getView()->renderTemplate('tarteaucitron/services/twitter-share-button', [
            'via'      => $this->via,
            'size'     => $this->isLarge ? 'large' : 'normal',
            'text'     => $this->text,
            'url'      => $this->url,
            'lang'     => $this->lang,
            'hashtags' => $this->hashtags,
            'related'  => $this->related,
        ]);
        Craft::$app->getView()->setTemplateMode($oldMode);

        return new Markup($html, 'UTF-8');
    }
}
