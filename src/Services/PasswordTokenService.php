<?php

declare(strict_types=1);

namespace App\Services;

class PasswordTokenService implements PasswordTokenServiceInterface
{
    public function createPasswordToken($email): string
    {
        return md5($email);
    }
}
