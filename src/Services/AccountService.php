<?php

declare(strict_types=1);

namespace App\Services;

use App\Database\RealmdDatabase;
use App\WowSrp\UserClient;
use RuntimeException;

final readonly class AccountService
{
    public function __construct(protected RealmdDatabase $db)
    {
    }

    public function accountExists(string $username): bool
    {
        return $this->db->accountExists($username);
    }

    public function createAccount(string $username, string $password): void
    {
        if ($this->accountExists($username)) {
            throw new RuntimeException("Account with username '$username' already exists.");
        }

        $username = mb_strtoupper($username);

        $client   = new UserClient($username);
        $salt     = $client->generateSalt();
        $verifier = $client->generateVerifier($password);

        $this->db->createAccount($username, $salt, $verifier);
    }

    public function changePassword(string $username, string $currentPassword, string $newPassword): void
    {
        if (!$this->accountExists($username)) {
            throw new RuntimeException("Account with username '$username' does not exist.");
        }

        $salt = $this->db->getSaltByUsername($username);

        $client = new UserClient($username, $salt);

        $currentVerifier = $client->generateVerifier($currentPassword);
        if (!$this->db->verifyPassword($username, $currentVerifier)) {
            throw new RuntimeException('Current password is incorrect.');
        }

        $newVerifier = $client->generateVerifier($newPassword);
        $this->db->updateAccountPassword($username, $salt, $newVerifier);
    }
}
