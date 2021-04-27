<?php

namespace App\Library;

/**
 * Class Db
 * @package App\Library
 */
class Db extends \mysqli
{

    /**
     * @var Db|null
     */
    private static $instance = null;

    /**
     * Db constructor.
     * @param $host
     * @param $user
     * @param $password
     * @param $database
     */
    private function __construct($host, $user, $password, $database)
    {
        parent::__construct($host, $user, $password, $database);
        $this->set_charset("utf8");
    }

    /**
     * Singleton instance of mysqli connection
     * @return Db
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        }
        return self::$instance;
    }
}
