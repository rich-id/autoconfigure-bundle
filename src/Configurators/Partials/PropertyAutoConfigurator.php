<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Configurators\Partials;

use RichId\AutoconfigureBundle\Annotation\Property;
use RichId\AutoconfigureBundle\Configurators\Basics\ServiceAutoConfiguratorInterface;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class PropertyAutoConfigurator.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class PropertyAutoConfigurator implements ServiceAutoConfiguratorInterface
{
    public function autoconfigure(
        Container $container,
        Definition $definition,
        ServiceConfiguration $configuration
    ): void {
        foreach ($configuration->getProperties() as $property => $options) {
            $type = $options['type'] ?? null;
            $value = $options['value'] ?? null;

            switch ($type) {
                case Property::SERVICE_TYPE:
                    $definition->setProperty($property, new Reference($value));
                    break;

                case Property::PARAMETER_TYPE:
                    $definition->setProperty($property, $container->getParameter($value));
                    break;

                default:
                    throw new \UnexpectedValueException('The property type used a service configuration is wrong.');
            }
        }
    }
}
