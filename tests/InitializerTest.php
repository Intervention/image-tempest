<?php

declare(strict_types=1);

namespace Intervention\Image\Tempest\Tests;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Interfaces\ImageManagerInterface;
use Intervention\Image\Tempest\Config;
use Intervention\Image\Tempest\Initializer;
use Mockery;
use PHPUnit\Framework\TestCase;
use Tempest\Container\Container;

class InitializerTest extends TestCase
{
    public function testInitialize(): void
    {
        $imageManager = new Initializer(
            new Config(Driver::class),
        )->initialize(Mockery::mock(Container::class));

        $this->assertInstanceOf(ImageManagerInterface::class, $imageManager);
    }
}
