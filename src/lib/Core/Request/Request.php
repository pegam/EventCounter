<?php

namespace Core\Request;

use Core\Request\Url\UrlInterface;
use Core\Request\RestMethod\RestMethodInterface;
use Core\Request\Params\ParamsInterface;

/**
 * Class Request
 *
 * @package Core\Request
 */
class Request implements RequestInterface {

    /** @var UrlInterface */
    private $url;

    /** @var RestMethodInterface */
    private $restMethod;

    /** @var ParamsInterface */
    private $getParams;

    /** @var ParamsInterface */
    private $postParams;

    /**
     * Request constructor.
     *
     * @param UrlInterface $url
     * @param RestMethodInterface $restMethod
     * @param ParamsInterface $getParams
     * @param ParamsInterface $postParams
     */
    public function __construct(
        UrlInterface $url, RestMethodInterface $restMethod, ParamsInterface $getParams, ParamsInterface $postParams
    ) {
        $this->url = $url;
        $this->restMethod = $restMethod;
        $this->getParams = $getParams;
        $this->postParams = $postParams;
    }

    /**
     * @return UrlInterface
     */
    public function getUrl() {
        return clone $this->url;
    }

    /**
     * @return RestMethodInterface
     */
    public function getRestMethod() {
        return clone $this->restMethod;
    }

    /**
     * @return ParamsInterface
     */
    public function getGetParams() {
        return clone $this->getParams;
    }

    /**
     * @return ParamsInterface
     */
    public function getPostParams() {
        return clone $this->postParams;
    }

}