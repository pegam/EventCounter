<?php

namespace Core\Controller\Dispatcher;

use Core\Controller\Container\ContainerInterface;

/**
 * Interface DispatcherInterface
 *
 * @package Core\Controller\Dispatcher
 */
interface DispatcherInterface {

    /**
     * @return ContainerInterface
     * @throws \Exception
     */
    public function dispatch();

}