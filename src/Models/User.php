<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\PasswordTokenServiceInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * This class is example of dirty code
 */
class User extends Model
{
    private Property $property;
    private PasswordTokenServiceInterface $passwordTokenService;
    private string $firstName;
    private string $secondName;
    private string $email;
    private string $password;
    private int $balance;
    private int $id;

    public function login(string $email, string $password): bool
    {
        $user = $this
            ->where('email', $email)
            ->get()
            ->first();

        return password_verify($password, $user->password);
    }

    public function register(string $email, string $password): void
    {
        // some validation
        self::create([
            'email' => $email,
            'password' => password_hash($password, 'empty'),
        ]);
    }

    public function restorePassword(string $email): void
    {
        // validation
        $token = $this->passwordTokenService->createPasswordToken($email);
        $this->update([
            'reset_token' => $token,
        ]);

        $this->email->send(
            $email,
            'Password restore',
            'views/auth/restorePassword',
            ['token' => $token]
        );
    }

    public function getFullName(): string
    {
        return $this->secondName . ' ' . $this->firstName;
    }

    public function addBalance(float $sum)
    {
        return $this->getBalance()->addSum($sum);
    }

    public function getBillingStatistics()
    {
        return BillingHistory::where('user_id', $this->id)
            ->groupBy('created_at')
            ->get();
    }

    public function getPaymentsStatistics()
    {
        return Payments::where('user_id', $this->id)
            ->groupBy('created_at')
            ->get();
    }

    public function getProperty(): Property
    {
        return $this->property;
    }

    public function setProperty(Property $property): void
    {
        $this->property = $property;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function setSecondName(string $secondName): void
    {
        $this->secondName = $secondName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function setBalance(int $balance): void
    {
        $this->balance = $balance;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setPasswordTokenService(PasswordTokenServiceInterface $passwordTokenService): void
    {
        $this->passwordTokenService = $passwordTokenService;
    }
}
