<?php

namespace Core\Request\RestMethod;

class RestMethod implements RestMethodInterface {

    /** @var string */
    private $methodName;

    /**
     * RestMethod constructor.
     *
     * @throws \Exception
     */
    public function __construct() {
        $this->methodName = $this->getMethodName();
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function getMethodName() {
        $methodName = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
        if (!$methodName) {
            throw new \Exception('Bad method name', 400);
        }
        return $methodName;
    }

    /**
     * @return string
     */
    public function getMethod() {
        return $this->methodName;
    }

}