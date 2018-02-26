<?php

namespace Model\Events\Validator;

use Core\Validator\ValidatorInterface;
use Model\Events\EventsEnum;

/**
 * Class EventsValidator
 *
 * @package Model\Events\Validator
 */
class EventsValidator implements ValidatorInterface {

    /**
     * @param mixed $data
     * @return void
     * @throws \Exception
     */
    public function validate($data) {
        if (!is_array($data)) {
            throw new \Exception('Not array', 500);
        }
        if (!isset($data['date']) || !preg_match('/^\\d{4}\\-\\d{2}\\-\\d{2}$/', $data['date'])) {
            $date = '';
            if (isset($data['date'])) {
                $date = $data['date'];
            }
            throw new \Exception('Bad date (date: \'' . $date . '\')', 400);
        }
        if (!isset($data['country']) || !preg_match('/^[A-Za-z]{2}$/', $data['country'])) {
            $country = '';
            if (isset($data['country'])) {
                $country = $data['country'];
            }
            throw new \Exception('Bad country (country: \'' . $country . '\')', 400);
        }
        if (!isset($data['event']) || !in_array($data['event'], EventsEnum::getAvailableEvents())) {
            $event = '';
            if (isset($data['event'])) {
                $event = $data['event'];
            }
            throw new \Exception('Bad event (event: \'' . $event . '\')', 400);
        }
    }

}