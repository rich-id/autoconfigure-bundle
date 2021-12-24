<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Configurators\Partials;

use RichId\AutoconfigureBundle\Annotation\AbstractServiceInjectionAnnotation;
use RichId\AutoconfigureBundle\Configurators\Basics\ServiceAutoConfiguratorInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

abstract class AbstractServiceInjectionAutoConfigurator implements ServiceAutoConfiguratorInterface
{
    protected function resolveObject(ContainerBuilder $container, array $options)
    {
        $type = $options['type'] ?? null;
        $value = $options['value'] ?? null;

        switch ($type) {
            case AbstractServiceInjectionAnnotation::SERVICE_TYPE:
                return new Reference($value);

            case AbstractServiceInjectionAnnotation::PARAMETER_TYPE:
                return $container->getParameter($value);

            case AbstractServiceInjectionAnnotation::SERVICES_BY_TAG:
                $serviceTags = $container->findTaggedServiceIds($value);

                return \array_map(
                    static function (string $serviceId): Reference {
                        return new Reference($serviceId);
                    },
                    \array_keys($serviceTags)
                );

            default:
                throw new \UnexpectedValueException('The type used a service configuration is wrong.');
        }
    }
}
