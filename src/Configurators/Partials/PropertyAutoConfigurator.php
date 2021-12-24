<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Configurators\Partials;

use RichId\AutoconfigureBundle\Model\ServiceConfiguration;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Class PropertyAutoConfigurator.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class PropertyAutoConfigurator extends AbstractServiceInjectionAutoConfigurator
{
    public function autoconfigure(
        ContainerBuilder $container,
        Definition $definition,
        ServiceConfiguration $configuration
    ): void {
        foreach ($configuration->getProperties() as $property => $options) {
            $sanitizedProperty = \str_replace('$', '', $property);
            $value = $this->resolveObject($container, $options);
            $definition->setProperty($sanitizedProperty, $value);
        }
    }
}
