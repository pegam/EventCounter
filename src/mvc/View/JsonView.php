<?php

namespace View;

use Core\View\ViewCommon;
use Core\Formatter\FormatterInterface;
use Core\Formatter\JsonFormatter;

/**
 * Class JsonView
 *
 * @package View
 */
class JsonView extends ViewCommon {

    /**
     * @return void
     */
    public function sendContentTypeHeader() {
        header('Content-Type: application/json', true);
    }

    /**
     * @return FormatterInterface
     */
    protected function createDefaultFormatter() {
        return new JsonFormatter();
    }

}