<?php

namespace Core\Formatter;

/**
 * Class PlainTextFormatter
 *
 * @package Core\Formatter
 */
class PlainTextFormatter implements FormatterInterface {

    /**
     * @param mixed $data
     * @return string
     */
    public function format($data) {
        return $data;
    }

}