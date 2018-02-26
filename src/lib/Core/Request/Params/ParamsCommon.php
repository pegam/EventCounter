<?php

namespace Core\Request\Params;

/**
 * Class ParamsCommon
 *
 * @package Core\Request\Params
 */
abstract class ParamsCommon implements ParamsInterface {

    /** @var array */
    protected $params;

    /**
     * @param string $paramName
     * @return mixed|null
     */
    public function get($paramName) {
        $result = null;
        if (isset($this->params[$paramName])) {
            $result = $this->params[$paramName];
        }
        return $result;
    }

    /**
     * @return array
     */
    public function getAll() {
        return $this->params;
    }

    /**
     * @param array $rawParams
     * @return array
     */
    protected function sanitizeParams(array $rawParams) {
        $params = [];
        foreach ($rawParams as $rawKey => $rawValue) {
            $key = filter_var($rawKey);
            if (false !== $key) {
                if (is_array($rawValue)) {
                    $value = $this->sanitizeParams($rawValue);
                } else {
                    $value = filter_var((string)$rawValue);

                }
                if (false !== $value) {
                    $params[$key] = $value;
                }
            }
        }
        return $params;
    }

}