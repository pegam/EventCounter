<?php

namespace Core\Request\Url;

/**
 * Class Url
 *
 * @package Core\Request\Url
 */
class Url implements UrlInterface {

    /** @var array */
    private $urlInfo;

    /**
     * Url constructor.
     *
     * @param $requestUri
     */
    public function __construct($requestUri) {
        $this->urlInfo = parse_url($requestUri);
    }

    /**
     * @return string
     */
    public function getPath() {
        $result = '';
        if (isset($this->urlInfo['path'])) {
            $result = strtolower($this->urlInfo['path']);
        }
        return $result;
    }

}