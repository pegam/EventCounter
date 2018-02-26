<?php

namespace Core\Request\Params;

/**
 * Class PostParams
 *
 * @package Core\Request\Params
 */
class PostParams extends ParamsCommon {

    /**
     * GetParams constructor.
     */
    public function __construct() {
        $rawParams = $this->getInput();
        $this->params = $this->sanitizeParams($rawParams);
    }

    private function getInput() {
        $input = file_get_contents('php://input');
        $json = json_decode($input, true);
        $params = [];
        if (null !== $json) {
            $params = $json;
        }
        return $params;
    }

}