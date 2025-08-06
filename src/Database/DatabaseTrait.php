<?php

declare(strict_types=1);

namespace App\Database;

use Nette\Database\Connection;

trait DatabaseTrait
{
    public function getConnection(string $database): Connection
    {
        $host     = getenv('DB_HOST');
        $port     = getenv('DB_PORT');
        $charset  = getenv('DB_CHARSET');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');

        $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=$charset";

        return new Connection($dsn, $username, $password);
    }
}
