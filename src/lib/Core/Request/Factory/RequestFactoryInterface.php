<?php

namespace Core\Request\Factory;

use Core\Request\RequestInterface;

/**
 * Interface RequestFactoryInterface
 *
 * @package Core\Request\Factory
 */
interface RequestFactoryInterface {

    /**
     * @return RequestInterface
     * @throws \Exception
     */
    public function create();

}