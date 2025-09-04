<?php

declare(strict_types=1);

namespace App\Services;

final class FeatureService
{
    protected bool $characterListEnabled;
    protected bool $signupEnabled;
    protected bool $changePasswordEnabled;

    public function __construct()
    {
        $envKeys = [
            'APP_CHARACTER_LIST_ENABLED'  => 'characterListEnabled',
            'APP_SIGNUP_ENABLED'          => 'signupEnabled',
            'APP_CHANGE_PASSWORD_ENABLED' => 'changePasswordEnabled',
        ];

        foreach ($envKeys as $envKey => $property) {
            $value           = $_ENV[$envKey] ?? 'false';
            $this->$property = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        }
    }

    public function characterListEnabled(): bool
    {
        return $this->characterListEnabled;
    }

    public function signupEnabled(): bool
    {
        return $this->signupEnabled;
    }

    public function changePasswordEnabled(): bool
    {
        return $this->changePasswordEnabled;
    }
}
