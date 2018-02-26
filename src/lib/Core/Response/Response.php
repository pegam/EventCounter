<?php

namespace Core\Response;

use Core\View\ViewInterface;

/**
 * Class Response
 *
 * @package Core\Response
 */
class Response implements ResponseInterface {

    /** @var ViewInterface */
    private $view;

    /**
     * Response constructor.
     *
     * @param ViewInterface $view
     */
    public function __construct(ViewInterface $view) {
        $this->view = $view;
    }

    /**
     * @return void
     */
    public function output() {
        $this->view->sendContentTypeHeader();
        echo (string)$this->view->getContent();
    }

}