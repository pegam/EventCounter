<?php

namespace Core\Request\Params;

/**
 * Class Params
 *
 * @package Core\Request\Params
 */
class GetParams extends ParamsCommon {

    /**
     * GetParams constructor.
     */
    public function __construct() {
        $this->params = $this->sanitizeParams($_GET);
    }

}