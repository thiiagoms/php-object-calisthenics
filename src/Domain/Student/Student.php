<?php

namespace Thiiagoms\Calisthenics\Domain\Student;

use DateTimeInterface;
use Thiiagoms\Calisthenics\Domain\Address\Address;
use Thiiagoms\Calisthenics\Domain\Email\Email;
use Thiiagoms\Calisthenics\Domain\FullName\FullName;
use Thiiagoms\Calisthenics\Domain\Video\Video;

class Student
{
    private WatchedVideos $watchedVideos;

    public function __construct(
        private Email $email,
        private DateTimeInterface $birthDate,
        private FullName $fullName,
        private Address $address
    ) {
        $this->watchedVideos = new WatchedVideos;
    }

    public function fullName(): string
    {
        return (string) $this->fullName;
    }

    public function email(): string
    {
        return (string) $this->email;
    }

    public function address(): array
    {
        return $this->address->toArray();
    }

    public function birthDate(): DateTimeInterface
    {
        return $this->birthDate;
    }

    public function watch(Video $video, DateTimeInterface $date): void
    {
        $this->watchedVideos->add($video, $date);
    }

    public function hasAccess(): bool
    {
        if ($this->watchedVideos->count() === 0) {
            return true;
        }

        $firstDate = $this->watchedVideos->dateOfFirstVideo();

        $today = new \DateTimeImmutable;

        return $firstDate->diff($today)->days < 90;
    }

    public function age(): int
    {
        $today = new \DateTimeImmutable;

        $dateInterval = $this->birthDate()->diff($today);

        return $dateInterval->y;
    }
}
