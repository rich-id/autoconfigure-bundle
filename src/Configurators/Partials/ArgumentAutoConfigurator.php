<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Configurators\Partials;

use RichId\AutoconfigureBundle\Model\ServiceConfiguration;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Class ArgumentAutoConfigurator.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class ArgumentAutoConfigurator extends AbstractServiceInjectionAutoConfigurator
{
    public function autoconfigure(
        ContainerBuilder $container,
        Definition $definition,
        ServiceConfiguration $configuration
    ): void {
        foreach ($configuration->getArguments() as $argument => $options) {
            $sanitizedArgument = $argument[0] === '$' ? $argument : '$' . $argument;

            $definition->setArgument(
                $sanitizedArgument,
                $this->resolveObject($container, $options)
            );
        }
    }
}
