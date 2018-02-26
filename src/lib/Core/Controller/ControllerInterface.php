<?php

namespace Core\Controller;

use Core\View\ViewInterface;

/**
 * Interface ControllerInterface
 *
 * @package Core\Controller
 */
interface ControllerInterface {

    /**
     * @return string
     */
    public function getAction();

    /**
     * @return ViewInterface
     */
    public function getView();

}