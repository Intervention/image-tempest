<?php

declare(strict_types=1);

namespace Intervention\Image\Tempest;

use Intervention\Image\Exceptions\InvalidArgumentException;
use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\ImageManagerInterface;
use Tempest\Container\Container;
use Tempest\Container\Initializer as TempestInitializer;

class Initializer implements TempestInitializer
{
    public function __construct(protected Config $config)
    {
        //
    }

    /**
     * Initialize new intervention image manager.
     *
     * @throws InvalidArgumentException
     */
    public function initialize(Container $container): ImageManagerInterface
    {
        return new ImageManager($this->config->driver());
    }
}
