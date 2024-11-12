<?php

declare(strict_types=1);

namespace Thiiagoms\Calisthenics\Domain\Address;

class Address
{
    public function __construct(
        private readonly string $street,
        private readonly string $number,
        private readonly string $province,
        private readonly string $city,
        private readonly string $state,
        private readonly string $country
    ) {}

    public function toArray(): array
    {
        return [
            'street' => $this->street,
            'number' => $this->number,
            'province' => $this->province,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
        ];
    }
}
