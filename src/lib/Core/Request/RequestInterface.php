<?php

namespace Core\Request;

use Core\Request\Url\UrlInterface;
use Core\Request\RestMethod\RestMethodInterface;
use Core\Request\Params\ParamsInterface;

/**
 * Interface RequestInterface
 *
 * @package Core\Request
 */
interface RequestInterface {

    /**
     * @return UrlInterface
     */
    public function getUrl();

    /**
     * @return RestMethodInterface
     */
    public function getRestMethod();

    /**
     * @return ParamsInterface
     */
    public function getGetParams();

    /**
     * @return ParamsInterface
     */
    public function getPostParams();

}