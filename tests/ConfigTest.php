<?php

declare(strict_types=1);

namespace Intervention\Image\Tempest\Tests;

use Generator;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;
use Intervention\Image\Tempest\Config;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testConstructor(): void
    {
        $this->assertInstanceOf(Config::class, new Config(GdDriver::class));
    }

    #[DataProvider('provideDrivers')]
    public function testDriver(string $driver): void
    {
        $this->assertInstanceOf($driver, new Config($driver)->driver());
    }

    public static function provideDrivers(): Generator
    {
        yield [GdDriver::class];
        yield [ImagickDriver::class];
    }
}
