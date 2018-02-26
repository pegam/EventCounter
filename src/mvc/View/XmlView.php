<?php

namespace View;

use Core\View\ViewCommon;
use Core\Formatter\FormatterInterface;
use Core\Formatter\XmlFormatter;

/**
 * Class XmlView
 *
 * @package View
 */
class XmlView extends ViewCommon {

    /**
     * @return void
     */
    public function sendContentTypeHeader() {
        header('Content-Type: application/xml', true);
    }

    /**
     * @return FormatterInterface
     */
    protected function createDefaultFormatter() {
        return new XmlFormatter();
    }

}