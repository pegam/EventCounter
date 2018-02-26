<?php

require_once __DIR__ . '/MigrationInterface.php';

use \Core\Db\Db;

/**
 * Class CreateCountriesCountTable
 */
class CreateCountriesCountTable implements MigrationInterface {

    /**
     * @return void
     */
    public function up() {
        $sql = 'CREATE TABLE CountriesCount (
                  Country VARCHAR(3) NOT NULL,
                  EventCount BIGINT NOT NULL,
                  PRIMARY KEY (Country)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8';
        Db::instance()->query($sql);
    }

}