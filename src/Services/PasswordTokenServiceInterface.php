<?php

namespace App\Services;

interface PasswordTokenServiceInterface
{
    public function createPasswordToken($email): string;
}
