<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Factory\Partials;

use RichId\AutoconfigureBundle\Annotation\AutoconfigureAnnotation;
use RichId\AutoconfigureBundle\Annotation\Method;
use RichId\AutoconfigureBundle\Factory\Basics\AbstractAnnotationServiceConfigurationFactory;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;

/**
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class MethodAnnotationServiceConfigurationFactory extends AbstractAnnotationServiceConfigurationFactory
{
    /** @var string */
    protected static $annotationClass = Method::class;

    /** @param AutoconfigureAnnotation|Method $annotation */
    protected static function hydrateServiceConfiguration(
        ServiceConfiguration $configuration,
        AutoconfigureAnnotation $annotation
    ): ServiceConfiguration {
        $methodCall = $configuration->getMethodCall($annotation->method);
        $methodCall[$annotation->position] = [
            'type'  => $annotation->type,
            'value' => $annotation->value,
        ];

        $configuration->setMethodCall($annotation->method, $methodCall);

        return $configuration;
    }
}
