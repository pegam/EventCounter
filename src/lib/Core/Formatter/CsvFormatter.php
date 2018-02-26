<?php

namespace Core\Formatter;

/**
 * Class CsvFormatter
 *
 * @package Core\Formatter
 */
class CsvFormatter implements FormatterInterface {

    /**
     * @param mixed $data
     * @return string
     */
    public function format($data) {
        $result = '';
        if (is_array($data) && $data) {
            $handle = fopen('php://memory', 'wb');
            if (is_array($data[0])) {
                $header = array_keys($data[0]);
                fputcsv($handle, $header);
            }
            foreach ($data as $row) {
                if (is_array($row)) {
                    fputcsv($handle, $row);
                }
            }
            fseek($handle, 0);
            $result = stream_get_contents($handle);
        }
        return $result;
    }

}