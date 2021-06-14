<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\DependencyInjection\CompilerPass;

use RichCongress\BundleToolbox\Configuration\AbstractCompilerPass;
use RichId\AutoconfigureBundle\Configurators\ServiceAutoConfigurator;
use Symfony\Component\Cache\Psr16Cache;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AutoconfigureCompilerPass.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
class AutoconfigureCompilerPass extends AbstractCompilerPass
{
    public const PRIORITY = 51;
    public const CLASSES_TO_SKIP = [Psr16Cache::class];

    public function process(ContainerBuilder $container): void
    {
        $taggedServices = $container->getDefinitions();

        foreach ($taggedServices as $serviceId => $tags) {
            $definition = $container->findDefinition($serviceId);
            ServiceAutoConfigurator::autoconfigure($container, $definition);
        }
    }
}
