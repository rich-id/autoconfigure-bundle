<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Factory\Partials;

use Doctrine\ORM\Mapping\Annotation;
use RichId\AutoconfigureBundle\Annotation\Argument;
use RichId\AutoconfigureBundle\Factory\Basics\AbstractAnnotationServiceConfigurationFactory;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;

/**
 * Class ArgumentAnnotationServiceConfigurationFactory.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class ArgumentAnnotationServiceConfigurationFactory extends AbstractAnnotationServiceConfigurationFactory
{
    /** @var string */
    protected static $annotationClass = Argument::class;

    /** @param Annotation|Argument $annotation */
    protected static function hydrateServiceConfiguration(
        ServiceConfiguration $configuration,
        Annotation $annotation
    ): ServiceConfiguration {
        $configuration->setArgument(
            $annotation->argument,
            [
                'type'  => $annotation->type,
                'value' => $annotation->value,
            ]
        );

        return $configuration;
    }
}
