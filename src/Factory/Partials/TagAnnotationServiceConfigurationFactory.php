<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Factory\Partials;

use RichId\AutoconfigureBundle\Annotation\AutoconfigureAnnotation;
use RichId\AutoconfigureBundle\Annotation\Tag;
use RichId\AutoconfigureBundle\Factory\Basics\AbstractAnnotationServiceConfigurationFactory;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;

/**
 * Class TagAnnotationServiceConfigurationFactory.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class TagAnnotationServiceConfigurationFactory extends AbstractAnnotationServiceConfigurationFactory
{
    /** @var string */
    protected static $annotationClass = Tag::class;

    /** @param AutoconfigureAnnotation|Tag $annotation */
    protected static function hydrateServiceConfiguration(
        ServiceConfiguration $configuration,
        AutoconfigureAnnotation $annotation
    ): ServiceConfiguration {
        $options = $annotation->options;
        $reflectionClass = new \ReflectionClass($annotation);
        $reflectionProperties = $reflectionClass->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($reflectionProperties as $reflectionProperty) {
            $name = $reflectionProperty->getName();
            $value = $reflectionProperty->getValue($annotation);

            if ($name === 'options' || $value === null) {
                continue;
            }

            $options[$name] = $value;
        }

        $configuration->addTag($options);

        return $configuration;
    }
}
