<?php

declare(strict_types=1);

namespace Thiiagoms\Calisthenics\Domain\FullName;

class FullName
{
    public function __construct(private readonly string $firstName, private readonly string $lastName) {}

    public function __toString(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }
}
