<?php

declare(strict_types=1);

namespace Intervention\Image\Tempest;

use Tempest\Core\Installer as InstallerAttribute;
use Tempest\Core\PublishesFiles;

use function Tempest\src_path;

class Installer
{
    use PublishesFiles;

    #[InstallerAttribute('Intervention Image', alias: 'image')]
    public function install(): void
    {
        $publishFiles = [
            __DIR__ . '/image.config.php' => src_path('image.config.php'),
        ];

        foreach ($publishFiles as $source => $destination) {
            $this->publish(
                source: $source,
                destination: $destination,
            );
        }

        $this->publishImports();
    }
}
