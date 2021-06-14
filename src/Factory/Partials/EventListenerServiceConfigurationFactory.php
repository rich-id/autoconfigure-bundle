<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Factory\Partials;

use RichId\AutoconfigureBundle\EventListener\EventListenerInterface;
use RichId\AutoconfigureBundle\Factory\Basics\ServiceConfigurationFactoryInterface;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;

/**
 * Class EventListenerServiceConfigurationFactory.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class EventListenerServiceConfigurationFactory implements ServiceConfigurationFactoryInterface
{
    public function create(\ReflectionClass $reflectionClass): array
    {
        $configuration = new ServiceConfiguration($reflectionClass);
        $configuration->addTag([
            'name' => 'kernel.event_listener',
        ]);

        return [$configuration];
    }

    public function supports(\ReflectionClass $reflectionClass): bool
    {
        return \is_subclass_of($reflectionClass->getName(), EventListenerInterface::class);
    }
}
