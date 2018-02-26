<?php

namespace Core\Db;

/**
 * Interface DbInterface
 *
 * @package Core\Db
 */
interface DbInterface {

    /**
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function get($sql, array $params = []);

    /**
     * @param string $sql
     * @param array $params
     * @return void
     */
    public function query($sql, array $params = []);

    /**
     * @return void
     */
    public function startTransaction();

    /**
     * @return void
     */
    public function commit();

    /**
     * @return void
     */
    public function rollBack();

}