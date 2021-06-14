<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Configurators\Partials;

use RichId\AutoconfigureBundle\Annotation\Argument;
use RichId\AutoconfigureBundle\Configurators\Basics\ServiceAutoConfiguratorInterface;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ArgumentAutoConfigurator.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class ArgumentAutoConfigurator implements ServiceAutoConfiguratorInterface
{
    public function autoconfigure(
        Container $container,
        Definition $definition,
        ServiceConfiguration $configuration
    ): void {
        foreach ($configuration->getArguments() as $argument => $options) {
            $definition->setArgument(
                $argument,
                $this->getObject($container, $options)
            );
        }
    }

    public function getObject(Container $container, array $options)
    {
        $type = $options['type'] ?? null;
        $value = $options['value'] ?? null;

        switch ($type) {
            case Argument::SERVICE_TYPE:
                return new Reference($value);

            case Argument::PARAMETER_TYPE:
                return $container->getParameter($value);

            default:
                throw new \UnexpectedValueException('The type used a service configuration is wrong.');
        }
    }
}
