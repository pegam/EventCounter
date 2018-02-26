<?php

namespace Core\Validator;

/**
 * Interface ValidatorInterface
 *
 * @package Core\Validator
 */
interface ValidatorInterface {

    /**
     * @param mixed $data
     * @return void
     * @throws \Exception
     */
    public function validate($data);

}