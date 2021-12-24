<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Factory\Partials;

use RichId\AutoconfigureBundle\Annotation\AbstractServiceInjectionAnnotation;
use RichId\AutoconfigureBundle\Annotation\Argument;
use RichId\AutoconfigureBundle\Annotation\AutoconfigureAnnotation;
use RichId\AutoconfigureBundle\Annotation\Decoration;
use RichId\AutoconfigureBundle\Annotation\Property;
use RichId\AutoconfigureBundle\Factory\Basics\AbstractAnnotationServiceConfigurationFactory;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;

/**
 * Class DecorationAnnotationServiceConfigurationFactory.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class DecorationAnnotationServiceConfigurationFactory extends AbstractAnnotationServiceConfigurationFactory
{
    /** @var string */
    protected static $annotationClass = Decoration::class;

    /** @param AutoconfigureAnnotation|Decoration $annotation */
    protected static function hydrateServiceConfiguration(
        ServiceConfiguration $configuration,
        AutoconfigureAnnotation $annotation
    ): ServiceConfiguration {
        $configuration->decorates($annotation->decorates);
        self::injectDecoratedService($configuration);

        return $configuration;
    }

    private static function injectDecoratedService(ServiceConfiguration $configuration): void
    {
        if (self::bindToConstructor($configuration)) {
            return;
        }

        if (self::bindToProperty($configuration)) {
            return;
        }

        self::bindToMethod($configuration);
    }

    private static function bindToConstructor(ServiceConfiguration $configuration): bool
    {
        $reflectionClass = $configuration->getTargetClass();
        $reflectionMethod = $reflectionClass->getConstructor();

        if ($reflectionMethod === null) {
            return false;
        }

        foreach ($reflectionMethod->getParameters() as $reflectionParameter) {
            if ($reflectionParameter->getName() !== 'innerService') {
                continue;
            }

            $configuration->setArgument(
                '$' . $reflectionParameter->getName(),
                [
                    'type'  => Argument::SERVICE_TYPE,
                    'value' => $reflectionClass->getName() . '.inner',
                ]
            );

            return true;
        }

        return false;
    }

    private static function bindToProperty(ServiceConfiguration $configuration): bool
    {
        $reflectionClass = $configuration->getTargetClass();

        if (!$reflectionClass->hasProperty('innerService')) {
            return false;
        }

        $reflectionProperty = $reflectionClass->getProperty('innerService');

        if (!$reflectionProperty->isPublic()) {
            return false;
        }

        $configuration->setProperty('innerService', [
            'type'  => Property::SERVICE_TYPE,
            'value' => $reflectionClass->getName() . '.inner',
        ]);

        return true;
    }

    private static function bindToMethod(ServiceConfiguration $configuration): void
    {
        $reflectionClass = $configuration->getTargetClass();

        if (!$reflectionClass->hasMethod('setInnerService')) {
            return;
        }

        $reflectionMethod = $reflectionClass->getMethod('setInnerService');

        if (!$reflectionMethod->isPublic()) {
            return;
        }

        $configuration->setMethodCall('setInnerService', [
            [
                'type'  => AbstractServiceInjectionAnnotation::SERVICE_TYPE,
                'value' => $reflectionClass->getName() . '.inner',
            ],
        ]);
    }
}
