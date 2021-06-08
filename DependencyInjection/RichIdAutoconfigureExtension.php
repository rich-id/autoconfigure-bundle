<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\DependencyInjection;

use RichCongress\BundleToolbox\Configuration\AbstractExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class RichIdAutoconfigureExtension extends AbstractExtension
{
    /** @param array<string, mixed> $configs */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $this->parseConfiguration(
            $container,
            new Configuration(),
            $configs
        );
    }
}
