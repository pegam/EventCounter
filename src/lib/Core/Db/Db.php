<?php

namespace Core\Db;

/**
 * Class Db
 *
 * @package Core\Db
 */
class Db implements DbInterface {

    /** @var Db */
    private static $obj;

    /** @var \PDO */
    private $pdo;

    /**
     * Db constructor.
     */
    private function __construct() {
        list($userName, $password) = $this->getCredentials();
        $this->pdo = new \PDO('mysql:host=localhost;dbname=Quantox;', $userName, $password);
    }

    /**
     * Clone
     */
    private function __clone() {}

    /** @noinspection PhpUnusedPrivateMethodInspection
     * Serialize
     */
    private function __sleep() {}

    /** @noinspection PhpUnusedPrivateMethodInspection
     * Unserialize
     */
    private function __wakeup() {}

    /**
     * @return array
     */
    private function getCredentials() {
        $result = ['root', ''];
        $config = __DIR__ . '/../../../../db.config.php';
        if (is_readable($config)) {
            $result = include $config;
        }
        return $result;
    }

    /**
     * @return Db
     */
    public static function instance() {
        if (null === self::$obj) {
            self::$obj = new Db();
        }
        return self::$obj;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function get($sql, array $params = null) {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return int
     */
    public function query($sql, array $params = null) {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);
        $result = $sth->rowCount();
        $sth->closeCursor();
        return $result;
    }

    /**
     * @return void
     */
    public function startTransaction() {
        $this->pdo->beginTransaction();
    }

    /**
     * @return void
     */
    public function commit() {
        $this->pdo->commit();
    }

    /**
     * @return void
     */
    public function rollBack() {
        $this->pdo->rollBack();
    }

}