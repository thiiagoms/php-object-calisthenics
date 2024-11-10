<?php

declare(strict_types=1);

namespace Thiiagoms\Calisthenics\Domain\Student;

use DateTimeInterface;
use Ds\Map;
use Thiiagoms\Calisthenics\Domain\Video\Video;

class Student
{
    private Map $watchedVideos;

    public function __construct(
        private string $email,
        private DateTimeInterface $bd,
        private string $firstName,
        private string $lastName,
        private string $street,
        private string $number,
        private string $province,
        private string $city,
        private string $state,
        private string $country
    ) {
        $this->watchedVideos = new Map;
        $this->setEmail($email);
    }

    public function getFullName(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }

    private function setEmail(string $email): void
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
            $this->email = $email;

            return;
        }

        throw new \InvalidArgumentException('Invalid e-mail address');
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBd(): DateTimeInterface
    {
        return $this->bd;
    }

    public function watch(Video $video, DateTimeInterface $date): void
    {
        $this->watchedVideos->put($video, $date);
    }

    public function hasAccess(): bool
    {
        if ($this->watchedVideos->count() > 0) {

            $this->watchedVideos->sort(fn (DateTimeInterface $dateA, DateTimeInterface $dateB) => $dateA <=> $dateB);

            /** @var DateTimeInterface $firstDate */
            $firstDate = $this->watchedVideos->first()->value;

            $today = new \DateTimeImmutable;

            if ($firstDate->diff($today)->days >= 90) {
                return false;
            }

            return true;
        }

        return true;
    }
}
