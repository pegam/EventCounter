<?php

namespace Core\Request\Factory;

use Core\Request\Url\Url;
use Core\Request\RestMethod\RestMethod;
use Core\Request\Params\GetParams;
use Core\Request\Params\PostParams;
use Core\Request\RequestInterface;
use Core\Request\Request;

/**
 * Class RequestFactory
 *
 * @package Core\Request\Factory
 */
class RequestFactory implements RequestFactoryInterface {

    /**
     * @return RequestInterface
     * @throws \Exception
     */
    public function create() {
        $url = new Url($_SERVER['REQUEST_URI']);
        $getParams = new GetParams();
        $postParams = new PostParams();
        $restMethod = new RestMethod();
        $request = new Request($url, $restMethod, $getParams, $postParams);
        return $request;
    }

}