<?php

require_once __DIR__ . '/MigrationInterface.php';

/**
 * Class CreateDatabase
 */
class CreateDatabase implements MigrationInterface {

    /**
     * @return void
     */
    public function up() {
        $sql = 'CREATE DATABASE IF NOT EXISTS Quantox DEFAULT CHARACTER SET utf8';
        list($userName, $password) = $this->getCredentials();
        $pdo = new \PDO('mysql:host=localhost;', $userName, $password);
        $pdo->exec($sql);
    }

    /**
     * @return array
     */
    private function getCredentials() {
        $result = ['root', ''];
        $config = __DIR__ . '/../db.config.php';
        if (is_readable($config)) {
            $result = include $config;
        }
        return $result;
    }

}