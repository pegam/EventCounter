<?php

namespace Core\Formatter;

class XmlFormatter implements FormatterInterface {

    /**
     * @param mixed $data
     * @return string
     */
    public function format($data) {
        $xml = new \SimpleXMLElement('<data/>');
        $this->arrayToXml((array)$data, $xml);
        $formatted = $xml->asXML();
        return $formatted;
    }

    private function arrayToXml(array $data, \SimpleXMLElement $xml) {
        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $key = 'item';
            }
            if (is_array($value)) {
                $child = $xml->addChild($key);
                $this->arrayToXml($value, $child);
            } else {
                $xml->addChild((string)$key, htmlspecialchars((string)$value));
            }
        }
    }

}