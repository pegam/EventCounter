<?php

namespace Core\Controller\Container;

use Core\Response\ResponseInterface;

/**
 * Interface ContainerInterface
 *
 * @package Core\Controller\Container
 */
interface ContainerInterface {

    /**
     * @return void
     */
    public function execAction();

    /**
     * @return ResponseInterface
     */
    public function createResponse();

}