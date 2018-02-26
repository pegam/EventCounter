<?php

namespace Core\Controller\Dispatcher;

use Core\Request\Factory\RequestFactory;
use Core\Controller\Container\ContainerInterface;
use Core\Controller\Container\Container;

/**
 * Class Dispatcher
 *
 * @package Core\Controller\Dispatcher
 */
class Dispatcher implements DispatcherInterface {

    /**
     * @return ContainerInterface
     * @throws \Exception
     */
    public function dispatch() {
        $requestFactory = new RequestFactory();
        $request = $requestFactory->create();
        $className = $this->getControllerClassName($request->getUrl()->getPath());
        if (!class_exists($className)) {
            throw new \Exception('Controller not found', 404);
        }
        $controller = new $className($request);
        $controllerContainer = new Container($controller);
        return $controllerContainer;
    }

    /**
     * @param string $path
     * @return string
     */
    private function getControllerClassName($path) {
        $className = 'Controller\\';
        $path = trim(trim($path, '/'));
        if (!$path || $path === 'index.php' || $path === 'doc.json') {
            $className .= 'Doc';
        } else {
            $parts = $this->getPathParts($path);
            $parts = array_map('ucfirst', $parts);
            $className .= implode('\\', $parts);
        }
        return $className;
    }

    /**
     * @param string $url
     * @return string[]
     */
    private function getPathParts($url) {
        $url = trim(trim($url), '/');
        $parts = explode('/', $url);
        return $parts;
    }

}