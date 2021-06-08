<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Factory\Partials;

use Doctrine\Common\Annotations\AnnotationReader;
use RichId\AutoconfigureBundle\Annotation\ServiceTag;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;

/**
 * Class TagAnnotationServiceConfigurationFactory.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class TagAnnotationServiceConfigurationFactory implements ServiceConfigurationFactoryInterface
{
    /** @var AnnotationReader */
    private static $annotationReader;

    public function create(\ReflectionClass $reflectionClass): array
    {
        $annotations = self::getAnnotations($reflectionClass);

        return \array_map([self::class, 'buildServiceConfiguration'], $annotations);
    }

    public function supports(\ReflectionClass $reflectionClass): bool
    {
        $annotations = self::getAnnotations($reflectionClass);

        return !empty($annotations);
    }

    private static function getAnnotations(\ReflectionClass $reflectionClass): array
    {
        self::$annotationReader = self::$annotationReader ?? new AnnotationReader();
        $classAnnotations = self::$annotationReader->getClassAnnotations($reflectionClass);

        return \array_filter($classAnnotations, static function ($annotation): bool {
            return $annotation instanceof ServiceTag;
        });
    }

    private static function buildServiceConfiguration(ServiceTag $serviceTag): ServiceConfiguration
    {
        $options = $serviceTag->options;
        $reflectionClass = new \ReflectionClass($serviceTag);
        $reflectionProperties = $reflectionClass->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($reflectionProperties as $reflectionProperty) {
            $name = $reflectionProperty->getName();
            $value = $reflectionProperty->getValue($serviceTag);

            if ($name === 'options' || $value === null) {
                continue;
            }

            $options[$name] = $value;
        }

        $configuration = new ServiceConfiguration();
        $configuration->addTag($options);

        return $configuration;
    }
}
