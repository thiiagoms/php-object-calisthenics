<?php

declare(strict_types=1);

namespace Thiiagoms\Calisthenics\Domain\Email;

class Email
{
    public function __construct(private readonly string $email)
    {
        $this->validate($this->email);
    }

    private function validate(string $email): void
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid e-mail address');
        }
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
