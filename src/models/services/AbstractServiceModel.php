<?php

namespace lhs\tarteaucitron\models\services;

use Craft;
use craft\base\Model;
use craft\web\View;
use Twig\Markup;
use yii\helpers\Html;

/**
 * Class ServiceModel
 * @package lhs\tarteaucitron\models\services
 */
abstract class AbstractServiceModel extends Model
{
    /**
     * Return activation status
     * Preferably based on an model attribute
     *
     * @return boolean
     */
    abstract public function isServiceEnabled(): bool;

    /**
     * Return html for front rendering
     *
     * @return Markup
     */
    abstract public function getHtml(): Markup;

    /**
     * @param string $errors A string containing the error(s)
     * @param string $cause  The cause of the error. Used only in the log.
     * @return Markup
     */
    public static function getErrorHtml(string $errors, string $cause): Markup
    {
        ob_start();
        debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $trace = ob_get_clean();

        Craft::error(sprintf('%s%s%s', $cause, PHP_EOL, $trace), __METHOD__);

        $view = Craft::$app->getView();
        $oldTemplateMode = $view->getTemplateMode();
        $view->setTemplateMode(View::TEMPLATE_MODE_CP);

        $html = $view->renderTemplate('tarteaucitron-js/rendering-error', [
            'errors' => $errors,
        ]);

        $view->setTemplateMode($oldTemplateMode);

        return new Markup($html, 'UTF-8');
    }
}
