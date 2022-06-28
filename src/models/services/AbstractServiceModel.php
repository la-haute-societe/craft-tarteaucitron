<?php

namespace lhs\tarteaucitron\models\services;

use Craft;
use craft\base\Model;
use craft\web\View;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Markup;
use yii\base\Exception;

/**
 * Class ServiceModel
 * @package lhs\tarteaucitron\models\services
 */
abstract class AbstractServiceModel extends Model
{
    /**
     * Return activation status
     * Preferably based on a model attribute
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
     * @param string $cause The cause of the error. Used only in the log.
     * @return Markup
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws Exception
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

        $html = $view->renderTemplate('tarteaucitron/rendering-error', [
            'errors' => $errors,
        ]);

        $view->setTemplateMode($oldTemplateMode);

        return new Markup($html, 'UTF-8');
    }
}
