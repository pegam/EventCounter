<?php

namespace Core\Request\Params;

/**
 * Interface ParamsInterface
 *
 * @package Core\Request\Params
 */
interface ParamsInterface {

    /**
     * @param string $paramName
     * @return mixed|null
     */
    public function get($paramName);

    /**
     * @return array
     */
    public function getAll();

}