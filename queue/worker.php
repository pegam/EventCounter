<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../autoloader/autoloader.php';
require_once __DIR__ . '/JobWorker.php';

use \Pheanstalk\Pheanstalk;
use \Model\Events\EventsModel;

$pheanstalk = new Pheanstalk('127.0.0.1');
$worker = new JobWorker();

while (true) {
    $job = $pheanstalk->watch(EventsModel::PHEANSTALK_TUBE)->ignore('default')->reserve();
    if ($job) {
        $data = json_decode($job->getData(), true);
        $pheanstalk->delete($job);
        if (is_array($data)) {
            $worker->storeData($data);
        }
    }
}