<?php

namespace Core\Controller;

use Core\Request\RequestInterface;

abstract class Controller implements ControllerInterface {

    /** @var RequestInterface */
    protected $request;

    /**
     * Controller constructor.
     *
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request) {
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getAction() {
        $action = $this->request->getRestMethod()->getMethod();
        return strtolower($action);
    }

}