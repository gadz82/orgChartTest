<?php
namespace App\Repository;

use App\Repository\CQRS\RepositoryInterface;
use PDO;

trait RepositoryConnectionSingletonTrait{

    /**
     * @var RepositoryInterface
     */
    private $instance;

    /**
     * @var PDO
     */
    public PDO $connection;

    protected function __construct() { }

    /**
     * @return RepositoryInterface|RepositoryConnectionSingletonTrait
     */
    public function getInstance() {
        if (!self::$instance) {
            // new self() will refer to the class that uses the trait
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param PDO $connection
     */
    public function setConnection(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return PDO
     */
    public function getConnection() : PDO
    {
        return $this->connection;
    }

}
