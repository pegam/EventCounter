<?php

namespace Model\Events;

use Core\Cache\ApiCache;
use Pheanstalk\Exception;
use Pheanstalk\Pheanstalk;

/**
 * Class EventsModel
 *
 * @package Model\Events
 */
class EventsModel {

    const PHEANSTALK_TUBE = 'counter';

    /**
     * @param string[] $incomingData
     * @throws Exception
     */
    public function saveData(array $incomingData) {
        $pheanstalk = new Pheanstalk('127.0.0.1');
        if (!$pheanstalk->getConnection()->isServiceListening()) {
            throw new Exception('Queue is not running!');
        }
        $pheanstalk->useTube(self::PHEANSTALK_TUBE)->put(json_encode($incomingData));
    }

    /**
     * @param string $outputFormat
     * @return string
     */
    public function getData($outputFormat) {
        $key = 'events_count_' . $outputFormat;
        $result = ApiCache::instance()->get($key);
        if (!$result) {
            $result = '';
        }
        return $result;
    }

}