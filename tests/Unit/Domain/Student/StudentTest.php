<?php

declare(strict_types=1);

namespace Thiiagoms\Calisthenics\Tests\Unit\Domain\Student;

use PHPUnit\Framework\TestCase;
use Thiiagoms\Calisthenics\Domain\Student\Student;
use Thiiagoms\Calisthenics\Domain\Video\Video;

class StudentTest extends TestCase
{
    private Student $student;

    protected function setUp(): void
    {
        $this->student = new Student(
            'thiiagoms@proton.me',
            new \DateTimeImmutable('1996-04-03'),
            'Thiago',
            'Silva',
            'Rua de Exemplo',
            '71B',
            'Meu Bairro',
            'Minha Cidade',
            'Meu estado',
            'Brazil'
        );
    }

    public function testStudentWithoutWatchedVideosHasAccess(): void
    {
        $this->assertTrue($this->student->hasAccess());
    }

    public function testStudentWithFirstWatchedVideoInLessThan90DaysHasAccess(): void
    {
        $date = new \DateTimeImmutable('89 days');
        $this->student->watch(new Video, $date);

        $this->assertTrue($this->student->hasAccess());
    }

    public function testStudentWithFirstWatchedVideoInLessThan90DaysButOtherVideosWatchedHasAccess(): void
    {
        $this->student->watch(new Video, new \DateTimeImmutable('-89 days'));
        $this->student->watch(new Video, new \DateTimeImmutable('-60 days'));
        $this->student->watch(new Video, new \DateTimeImmutable('-30 days'));

        $this->assertTrue($this->student->hasAccess());
    }

    public function testStudentWithFirstWatchedVideoIn90DaysDoesntHaveAccess()
    {
        $date = new \DateTimeImmutable('-90 days');
        $this->student->watch(new Video, $date);

        $this->assertFalse($this->student->hasAccess());
    }

    public function testStudentWithFirstWatchedVideoIn90DaysButOtherVideosWatchedDoesntHaveAccess(): void
    {
        $this->student->watch(new Video, new \DateTimeImmutable('-90 days'));
        $this->student->watch(new Video, new \DateTimeImmutable('-60 days'));
        $this->student->watch(new Video, new \DateTimeImmutable('-30 days'));

        $this->assertFalse($this->student->hasAccess());
    }
}
