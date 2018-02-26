<?php

namespace Core\Controller\Container;

use Core\Controller\ControllerInterface;
use Core\Response\ResponseInterface;
use Core\Response\Response;

/**
 * Class Container
 *
 * @package Core\Controller\Container
 */
class Container implements ContainerInterface {

    /** @var ControllerInterface */
    private $controller;

    /**
     * Container constructor.
     *
     * @param ControllerInterface $controller
     */
    public function __construct(ControllerInterface $controller) {
        $this->controller = $controller;
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function execAction() {
        $action = $this->controller->getAction();
        if (!$action || !is_callable([$this->controller, $action])) {
            throw new \Exception(
                'Bad action (action: \'' . $action . '\', controller: \'' . get_class($this->controller) . '\')'
            );
        }
        $this->controller->$action();
    }

    /**
     * @return ResponseInterface
     */
    public function createResponse() {
        $view = $this->controller->getView();
        $response = new Response($view);
        return $response;
    }

}