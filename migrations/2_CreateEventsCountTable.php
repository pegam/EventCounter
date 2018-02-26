<?php

require_once __DIR__ . '/MigrationInterface.php';

use \Core\Db\Db;

/**
 * Class CreateEventsCountTable
 */
class CreateEventsCountTable implements MigrationInterface {

    /**
     * @return void
     */
    public function up() {
        $sql = 'CREATE TABLE EventsCount (
                  EventDate DATE NOT NULL,
                  Country VARCHAR(3) NOT NULL,
                  Event VARCHAR(10) NOT NULL,
                  EventCount BIGINT NOT NULL,
                  PRIMARY KEY (EventDate, Country, Event)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8';
        Db::instance()->query($sql);
    }

}