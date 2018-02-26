<?php

namespace Core\Formatter;

/**
 * Interface FormatterInterface
 *
 * @package Core\Formatter
 */
interface FormatterInterface {

    /**
     * @param mixed $data
     * @return string
     */
    public function format($data);

}