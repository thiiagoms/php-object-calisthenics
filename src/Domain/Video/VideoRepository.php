<?php

declare(strict_types=1);

namespace Thiiagoms\Calisthenics\Domain\Video;

use Thiiagoms\Calisthenics\Domain\Student\Student;

interface VideoRepository
{
    public function add(Video $video): void;

    public function videosFor(Student $student): array;
}
