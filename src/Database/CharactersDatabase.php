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
        $realmdDatabase = getenv('DB_NAME_REALMD');

        return $this->getConnection()->query(<<<SQL
            SELECT `characters`.`name`,
                `characters`.`race`,
                `characters`.`class`,
                `characters`.`level`,
                `characters`.`online`
            FROM `characters`
            WHERE `account` NOT IN (
                SELECT `account`.`id`
                FROM `$realmdDatabase`.`account`
                WHERE `account`.`gmlevel` > 0
            )
            ORDER BY `level` DESC, `name` ASC
        SQL
        )->fetchAll();
    }
}
