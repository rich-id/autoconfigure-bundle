<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Factory;

use RichId\AutoconfigureBundle\Factory\Partials\DecorationAnnotationServiceConfigurationFactory;
use RichId\AutoconfigureBundle\Factory\Partials\EventListenerServiceConfigurationFactory;
use RichId\AutoconfigureBundle\Factory\Partials\ServiceConfigurationFactoryInterface;
use RichId\AutoconfigureBundle\Factory\Partials\TagAnnotationServiceConfigurationFactory;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;

/**
 * Class ServiceConfigurationFactory.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class ServiceConfigurationFactory
{
    /** @var string[] */
    public const FACTORIES = [
        DecorationAnnotationServiceConfigurationFactory::class,
        EventListenerServiceConfigurationFactory::class,
        TagAnnotationServiceConfigurationFactory::class,
    ];

    /** @return ServiceConfiguration[] */
    public static function create(\ReflectionClass $reflectionClass): array
    {
        $configurations = [];

        foreach (self::FACTORIES as $factory) {
            /** @var ServiceConfigurationFactoryInterface $instance */
            $instance = new $factory();

            if ($instance->supports($reflectionClass)) {
                $configurations[] = $instance->create($reflectionClass);
            }
        }

        return \array_merge([], ...$configurations);
    }
}
