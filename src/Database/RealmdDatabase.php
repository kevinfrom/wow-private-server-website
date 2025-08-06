<?php

declare(strict_types=1);

namespace App\Database;

use Nette\Database\Connection;
use RuntimeException;

final readonly class RealmdDatabase
{
    use DatabaseTrait {
        getConnection as protected _getConnection;
    }

    protected function getConnection(): Connection
    {
        $database = getenv('DB_NAME_REALMD');

        if (!$database) {
            throw new RuntimeException('Database name for realmd is not set in environment variables.');
        }

        return $this->_getConnection($database);
    }

    public function accountExists(string $username): bool
    {
        $username = mb_strtoupper($username);

        $query = $this->getConnection()->query(<<<SQL
            SELECT COUNT(*) AS count
            FROM `account`
            WHERE `username` = ?
        SQL, $username);

        return $query->fetchField() > 0;
    }

    public function createAccount(string $username, string $salt, string $verifier): void
    {
        $username = mb_strtoupper($username);

        $this->getConnection()->query(<<<SQL
            INSERT INTO `account` (`username`, `s`, `v`)
            VALUES (?, ?, ?)
        SQL, $username, $salt, $verifier);
    }

    public function getSaltByUsername(string $username): string
    {
        $username = mb_strtoupper($username);

        $query = $this->getConnection()->query(<<<SQL
            SELECT `s`
            FROM `account`
            WHERE `username` = ?
        SQL, $username);

        return $query->fetchField() ?: '';
    }

    public function verifyPassword(string $username, string $verifier): bool
    {
        $username = mb_strtoupper($username);

        $query = $this->getConnection()->query(<<<SQL
            SELECT COUNT(*) AS count
            FROM `account`
            WHERE `username` = ? AND `v` = ?
        SQL, $username, $verifier);

        return $query->fetchField() > 0;
    }

    public function updateAccountPassword(string $username, string $salt, string $verifier): void
    {
        $username = mb_strtoupper($username);

        $this->getConnection()->query(<<<SQL
            UPDATE `account`
            SET `s` = ?, `v` = ?
            WHERE `username` = ?
        SQL, $salt, $verifier, $username);
    }
}
