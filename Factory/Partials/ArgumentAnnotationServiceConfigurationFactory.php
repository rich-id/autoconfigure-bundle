<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Factory\Partials;

use Doctrine\Common\Annotations\AnnotationReader;
use RichId\AutoconfigureBundle\Annotation\Argument;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;

/**
 * Class ArgumentAnnotationServiceConfigurationFactory.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class ArgumentAnnotationServiceConfigurationFactory implements ServiceConfigurationFactoryInterface
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
            return $annotation instanceof Argument;
        });
    }

    private static function buildServiceConfiguration(Argument $serviceArgument): ServiceConfiguration
    {
        $configuration = new ServiceConfiguration();
        $configuration->setArgument(
            $serviceArgument->argument,
            [
                'type'  => $serviceArgument->type,
                'value' => $serviceArgument->value,
            ]
        );

        return $configuration;
    }
}
