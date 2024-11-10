<?php

namespace Thiiagoms\Calisthenics\Tests\Unit\Domain\Video;

use PHPUnit\Framework\TestCase;
use Thiiagoms\Calisthenics\Domain\Video\Video;

class VideoTest extends TestCase
{
    public function testChangeVisibilityMustWork(): void
    {
        $video = new Video;
        $video->checkIfVisibilityIsValidAndUpdateIt(Video::PUBLIC);

        $this->assertSame(Video::PUBLIC, $video->getVisibility());
    }
}
