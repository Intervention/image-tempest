<?php

declare(strict_types=1);

namespace Intervention\Image\Tempest;

use Intervention\Image\Config as DriverConfig;
use Intervention\Image\Interfaces\ColorInterface;
use Intervention\Image\Interfaces\DriverInterface;

final class Config
{
    public function __construct(
        public string $driver,
        public bool $autoOrientation = true,
        public bool $decodeAnimation = true,
        public string|ColorInterface $backgroundColor = 'ffffff',
        public bool $strip = false,
    ) {
        //
    }

    public function driver(): DriverInterface
    {
        return new $this->driver(new DriverConfig(
            autoOrientation: $this->autoOrientation,
            decodeAnimation: $this->decodeAnimation,
            backgroundColor: $this->backgroundColor,
            strip: $this->strip,
        ));
    }
}
