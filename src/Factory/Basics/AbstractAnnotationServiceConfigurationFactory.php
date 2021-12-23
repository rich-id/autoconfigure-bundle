<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Factory\Basics;

use Doctrine\Common\Annotations\AnnotationReader;
use RichId\AutoconfigureBundle\Annotation\AutoconfigureAnnotation;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;

/**
 * Class AbstractAnnotationServiceConfigurationFactory.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
abstract class AbstractAnnotationServiceConfigurationFactory implements ServiceConfigurationFactoryInterface
{
    /** @var AnnotationReader */
    private static $annotationReader;

    /** @var string|null */
    protected static $annotationClass;

    public function create(\ReflectionClass $reflectionClass): array
    {
        $annotations = self::getAnnotations($reflectionClass);
        $configurations = [];

        foreach ($annotations as $annotation) {
            $config = new ServiceConfiguration($reflectionClass);
            $configurations[] = static::hydrateServiceConfiguration($config, $annotation);
        }

        return $configurations;
    }

    public function supports(\ReflectionClass $reflectionClass): bool
    {
        $annotations = self::getAnnotations($reflectionClass);

        return !empty($annotations);
    }

    private static function getAnnotations(\ReflectionClass $reflectionClass): array
    {
        if (static::$annotationClass === null) {
            throw new \InvalidArgumentException('Set the static property `$annotationClass` in the class ' . static::class);
        }

        self::$annotationReader = self::$annotationReader ?? new AnnotationReader();
        $classAnnotations = self::$annotationReader->getClassAnnotations($reflectionClass);

        if (\method_exists($reflectionClass, 'getAttributes')) {
            $attributes = \array_map(
                static function ($reflectionAttribute) {
                    return $reflectionAttribute->newInstance();
                },
                $reflectionClass->getAttributes()
            );

            $classAnnotations = \array_merge($classAnnotations, $attributes);
        }

        return \array_filter($classAnnotations, static function ($annotation): bool {
            return $annotation instanceof static::$annotationClass;
        });
    }

    abstract protected static function hydrateServiceConfiguration(
        ServiceConfiguration $configuration,
        AutoconfigureAnnotation $annotation
    ): ServiceConfiguration;
}
