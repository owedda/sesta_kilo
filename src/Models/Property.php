<?php

declare(strict_types=1);

namespace App\Models;

class Property
{
    public function __construct(
        private string $city,
        private string $street,
        private string $house,
        private string $apartment
    ) {
    }

    public function getAddressString(): string
    {
        $address  = [
            $this->getCity(),
            $this->getStreet(),
            $this->getHouse(),
            $this->getApartment(),
        ];

        return implode(" ", $address);
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getHouse(): string
    {
        return $this->house;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getApartment(): string
    {
        return $this->apartment;
    }

    public function setApartment(string $apartment): void
    {
        $this->apartment = $apartment;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function setHouse(string $house): void
    {
        $this->house = $house;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }
}
