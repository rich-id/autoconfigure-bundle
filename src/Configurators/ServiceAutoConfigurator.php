<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Configurators;

use RichId\AutoconfigureBundle\Configurators\Basics\ServiceAutoConfiguratorInterface;
use RichId\AutoconfigureBundle\Configurators\Partials\ArgumentAutoConfigurator;
use RichId\AutoconfigureBundle\Configurators\Partials\DecorationAutoConfigurator;
use RichId\AutoconfigureBundle\Configurators\Partials\MethodCallAutoConfigurator;
use RichId\AutoconfigureBundle\Configurators\Partials\PropertyAutoConfigurator;
use RichId\AutoconfigureBundle\Configurators\Partials\TagAutoConfigurator;
use RichId\AutoconfigureBundle\Factory\ServiceConfigurationFactory;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;
use Symfony\Component\Cache\Psr16Cache;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Class ServiceAutoConfigurator.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class ServiceAutoConfigurator
{
    /** @var string[] */
    public const CONFIGURATORS = [
        ArgumentAutoConfigurator::class,
        DecorationAutoConfigurator::class,
        MethodCallAutoConfigurator::class,
        PropertyAutoConfigurator::class,
        TagAutoConfigurator::class,
    ];

    /** @var string[] */
    public const CLASSES_TO_SKIP = [Psr16Cache::class];

    public static function autoconfigure(ContainerBuilder $container, Definition $definition): void
    {
        $class = $definition->getClass();

        if ($definition->isAbstract() || $definition->isSynthetic() || \in_array($class, self::CLASSES_TO_SKIP, true)) {
            return;
        }

        try {
            $reflectionClass = new \ReflectionClass($class);
            $configurations = ServiceConfigurationFactory::create($reflectionClass);

            foreach ($configurations as $configuration) {
                self::configure($container, $definition, $configuration);
            }
        } catch (\Throwable $e) {
            // Skip if it fails to get class information
        }
    }

    private static function configure(
        ContainerBuilder $container,
        Definition $definition,
        ServiceConfiguration $configuration
    ): void {
        foreach (self::CONFIGURATORS as $configurator) {
            /** @var ServiceAutoConfiguratorInterface $instance */
            $instance = new $configurator();
            $instance->autoconfigure($container, $definition, $configuration);
        }
    }
}
