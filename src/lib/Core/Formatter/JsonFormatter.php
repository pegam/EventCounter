<?php

namespace Core\Formatter;

/**
 * Class JsonFormatter
 *
 * @package Core\Formatter
 */
class JsonFormatter implements FormatterInterface {

    /**
     * @param mixed $data
     * @return string
     */
    public function format($data) {
        $formatted = json_encode($data);
        return $formatted;
    }

}