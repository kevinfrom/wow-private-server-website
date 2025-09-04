<?php

declare(strict_types=1);

namespace App\Http\Controller\Api;

use App\Services\AccountService;
use App\Services\FeatureService;
use RuntimeException;

final readonly class AccountController
{
    public function __construct(
        protected AccountService $accountService,
        protected FeatureService $featureService
    ) {
    }

    public function create(): never
    {
        if (!$this->featureService->signupEnabled()) {
            http_response_code(404);
            exit;
        }

        $username = mb_strtoupper($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            http_response_code(400);
            echo json_encode(['error' => 'Username and password are required.']);
            die;
        }

        try {
            $this->accountService->createAccount($username, $password);
            http_response_code(201);
            echo json_encode(['message' => 'Account created successfully.']);
        } catch (RuntimeException $e) {
            http_response_code(409);
            echo json_encode(['error' => $e->getMessage()]);
        }
        die;
    }

    public function changePassword(string $username): never
    {
        if (!$this->featureService->changePasswordEnabled()) {
            http_response_code(404);
            exit;
        }

        $currentPassword    = $_POST['current_password'] ?? '';
        $newPassword        = $_POST['new_password'] ?? '';
        $confirmNewPassword = $_POST['confirm_new_password'] ?? '';

        if (empty($currentPassword) || empty($newPassword) || empty($confirmNewPassword)) {
            http_response_code(400);
            echo json_encode(['error' => 'Current password and new password are required.']);
            exit;
        }

        if ($newPassword !== $confirmNewPassword) {
            http_response_code(400);
            echo json_encode(['error' => 'New password and confirmation do not match.']);
            exit;
        }

        try {
            $this->accountService->changePassword($username, $currentPassword, $newPassword);
            http_response_code(200);
            echo json_encode(['message' => 'Password changed successfully.']);
        } catch (RuntimeException $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }

        exit;
    }
}
