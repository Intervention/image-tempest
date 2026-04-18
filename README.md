# Intervention Image Tempest
## Tempest framework integration for Intervention Image

[![Latest Version](https://img.shields.io/packagist/v/intervention/image-tempest.svg)](https://packagist.org/packages/intervention/image-tempest)
[![Tests](https://github.com/Intervention/image-tempest/actions/workflows/build.yml/badge.svg)](https://github.com/Intervention/image-tempest/actions/workflows/build.yml)
[![Monthly Downloads](https://img.shields.io/packagist/dm/intervention/image-tempest.svg)](https://packagist.org/packages/intervention/image-tempest/stats)
[![Support me on Ko-fi](https://raw.githubusercontent.com/Intervention/image-tempest/main/.github/images/support.svg)](https://ko-fi.com/interventionphp)

This package provides an integration to setup [Intervention Image](https://image.intervention.io) easily to your [Tempest](https://tempestphp.com) application with a publishable configuration.

## Requirements

- Tempest >= 3.9

## Installation

In your existing Tempest application you can install this package using [Composer](https://getcomposer.org).

```bash
composer require intervention/image-tempest
```

## Features

Although Intervention Image can be used with Tempest without this extension,
this integration package includes the following features that make image
interaction with the framework much easier.

### Application-wide configuration

This integration package comes with a global configuration file that is recognized by
Tempest. It is therefore possible to store the settings for Intervention Image
once centrally and not have to define them individually each time you call the
image manager.

The configuration file can be copied to the application with the following command.

```bash
php tempest install image
```

The call will publish the configuration file `image.config.php` to your local application. Here you can set the desired driver and its configuration options for Intervention Image.

The configuration files looks like this.

```php
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Tempest\Config as ImageConfig;

return new ImageConfig(
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
```

You can read more about the different options for
[driver selection](https://image.intervention.io/v4/basics/configuration-drivers#driver-selection), setting options for 
[auto orientation](https://image.intervention.io/v4/modifying-images/effects#image-orientation-according-to-exif-data), 
[decoding animations](https://image.intervention.io/v4/modifying-images/animations) and 
[background color](https://image.intervention.io/v4/basics/colors#transparency).

### Injecting Dependencies

The following code example shows how to inject an image manager into your controller. The instance has already been automatically configured according to the config file. Of course you are not limited to inject into controller.

```php
use Intervention\Image\Format;
use Intervention\Image\Interfaces\ImageManagerInterface;
use Tempest\Router\Get;
use Tempest\View\View;

use function Tempest\View\view;

final readonly class HomeController
{
    public function __construct(private ImageManagerInterface $imageManager)
    {
        //
    }

    #[Get(uri: '/')]
    public function __invoke(): View
    {
        // process image
        $image = $this->imageManager
            ->decode('./example.jpg')
            ->scale(height: 300)
            ->encodeUsingFormat(Format::WEBP);

        return view('./home.view.php', dataUri: $image->toDataUri());
    }
}
```

## Authors

This library is developed and maintained by [Oliver Vogel](https://intervention.io)

Thanks to the community of [contributors](https://github.com/Intervention/image-tempest/graphs/contributors) who have helped to improve this project.

## License

Intervention Image Tempest is licensed under the [MIT License](LICENSE).
