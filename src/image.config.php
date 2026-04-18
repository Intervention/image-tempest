<?php

declare(strict_types=1);

use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Tempest\Config;

return new Config(
    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports “GD Library” and “Imagick” to process images
    | internally. Depending on your PHP setup, you can choose one of them.
    |
    | Included options:
    |   - \Intervention\Image\Drivers\Gd\Driver::class
    |   - \Intervention\Image\Drivers\Imagick\Driver::class
    |   - \Intervention\Image\Drivers\Vips\Driver::class
    */
    driver: \Tempest\env('IMAGE_DRIVER', GdDriver::class),
    /*
    |--------------------------------------------------------------------------
    | Configuration Options
    |--------------------------------------------------------------------------
    |
    | These options control the behavior of Intervention Image.
    |
    | - "autoOrientation" controls whether an imported image should be
    |    automatically rotated according to any existing Exif data.
    |
    | - "decodeAnimation" decides whether a possibly animated image is
    |    decoded as such or whether the animation is discarded.
    |
    | - "backgroundColor" Defines the default background & blending color.
    |
    | - "strip" controls if meta data like exif tags should be removed when
    |    encoding images.
    */
    autoOrientation: true,
    decodeAnimation: true,
    backgroundColor: 'ffffff',
    strip: false,
);
