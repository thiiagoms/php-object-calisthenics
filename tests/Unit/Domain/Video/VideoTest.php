<?php

namespace Thiiagoms\Calisthenics\Tests\Unit\Domain\Video;

use PHPUnit\Framework\TestCase;
use Thiiagoms\Calisthenics\Domain\Video\Video;

class VideoTest extends TestCase
{
    public function testMakingAVideoPublicMustWork(): void
    {
        $video = new Video;
        $video->publish();

        $this->assertTrue($video->isPublic());
    }
}
