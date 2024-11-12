<?php

declare(strict_types=1);

namespace Thiiagoms\Calisthenics\Tests\Unit\Domain\Video;

use PHPUnit\Framework\TestCase;
use Thiiagoms\Calisthenics\Domain\Student\Student;
use Thiiagoms\Calisthenics\Domain\Video\InMemoryVideoRepository;
use Thiiagoms\Calisthenics\Domain\Video\Video;

class InMemoryVideoRepositoryTest extends TestCase
{
    public function testFindingVideosForAStudentMustFilterAgeLimit(): void
    {
        $repository = new InMemoryVideoRepository;

        // [21, 20, 19, 18, 17]
        for ($i = 21; $i >= 17; $i--) {
            $video = new Video;
            $video->setAgeLimit($i);
            $repository->add($video);
        }

        $student = $this->createStub(Student::class);
        $student->method('age')->willReturn(19);

        $videoList = $repository->videosFor($student);

        $this->assertCount(3, $videoList);
    }
}
