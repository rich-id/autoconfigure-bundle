<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Factory\Partials;

use RichId\AutoconfigureBundle\Annotation\AutoconfigureAnnotation;
use RichId\AutoconfigureBundle\Annotation\Property;
use RichId\AutoconfigureBundle\Factory\Basics\AbstractAnnotationServiceConfigurationFactory;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;

/**
 * Class PropertyAnnotationServiceConfigurationFactory.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class PropertyAnnotationServiceConfigurationFactory extends AbstractAnnotationServiceConfigurationFactory
{
    /** @var string */
    protected static $annotationClass = Property::class;

    /** @param AutoconfigureAnnotation|Property $annotation */
    protected static function hydrateServiceConfiguration(
        ServiceConfiguration $configuration,
        AutoconfigureAnnotation $annotation
    ): ServiceConfiguration {
        $configuration->setProperty(
            $annotation->property,
            [
                'type'  => $annotation->type,
                'value' => $annotation->value,
            ]
        );

        return $configuration;
    }
}
