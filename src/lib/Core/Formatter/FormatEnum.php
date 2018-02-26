<?php

namespace Core\Formatter;

/**
 * Class FormatEnum
 *
 * @package Core\Formatter
 */
class FormatEnum {

    const FORMAT_JSON = 'json';
    const FORMAT_CSV = 'csv';
    const FORMAT_XML = 'xml';

    /**
     * @return string[]
     */
    public static function getAvailableFormats() {
        return [self::FORMAT_JSON, self::FORMAT_CSV, self::FORMAT_XML];
    }
}