<?php

namespace View;

use Core\View\ViewCommon;
use Core\Formatter\FormatterInterface;
use Core\Formatter\PlainTextFormatter;

/**
 * Class PlainTextView
 *
 * @package View
 */
class PlainTextView extends ViewCommon {

    /**
     * @return void
     */
    public function sendContentTypeHeader() {
        header('Content-Type: text/plain', true);
    }

    /**
     * @return FormatterInterface
     */
    protected function createDefaultFormatter() {
        return new PlainTextFormatter();
    }

}