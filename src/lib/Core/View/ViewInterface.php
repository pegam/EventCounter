<?php

namespace Core\View;

/**
 * Interface ViewInterface
 *
 * @package Core\View
 */
interface ViewInterface {

    /**
     * @return void
     */
    public function sendContentTypeHeader();

    /**
     * @return string
     */
    public function getContent();

}