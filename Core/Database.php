<?php

namespace Core;

use PDO;

class Database
{
    protected $connection;
    protected $stmt;

    public function __construct($config, $dbUser = 'root', $dbPass = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        $this->connection = new PDO($dsn, $dbUser, $dbPass, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {
        $this->stmt = $this->connection->prepare($query);
        $this->stmt->execute($params);

        return $this;
    }

    public function find()
    {
        return $this->stmt->fetch();
    }
    public function findAll()
    {
        return $this->stmt->fetchAll();
    }
}
