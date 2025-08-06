<?php

declare(strict_types=1);

namespace App\Database;

use Nette\Database\Connection;
use RuntimeException;

final readonly class CharactersDatabase
{
    use DatabaseTrait {
        getConnection as protected _getConnection;
    }

    protected function getConnection(): Connection
    {
        $database = getenv('DB_NAME_CHARACTERS');

        if (!$database) {
            throw new RuntimeException('Database name for characters is not set in environment variables.');
        }

        return $this->_getConnection($database);
    }

    public function getCharacters(): array
    {
        return $this->getConnection()->query(<<<SQL
            SELECT `name`, `race`, `class`, `level`, `online`
            FROM `characters`
            ORDER BY `online` DESC, `name` ASC
        SQL
        )->fetchAll();
    }
}
