<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\DependencyInjection\CompilerPass;

use Doctrine\Common\Annotations\AnnotationReader;
use RichCongress\BundleToolbox\Configuration\AbstractCompilerPass;
use RichId\AutoconfigureBundle\AutoTag\Annotation\ServiceTag;
use RichId\AutoconfigureBundle\Model\ServiceTagConfiguration;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Class TagAnnotationCompilerPass.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
class TagAnnotationCompilerPass extends AbstractCompilerPass
{
    public const PRIORITY = 51;
    public const AUTOCONFIGURE_SERVICE_TAG = 'rich_id.autoconfigure_service';

    public function process(ContainerBuilder $container): void
    {
        $taggedServices = $container->findTaggedServiceIds(static::AUTOCONFIGURE_SERVICE_TAG);

        foreach ($taggedServices as $serviceId => $tags) {
            $definition = $container->findDefinition($serviceId);
            $configuration = $this->getServiceTagConfiguration($definition);

            if ($configuration !== null) {
                $definition->addTag($configuration->name, $configuration->options);
            }
        }
    }

    protected function getServiceTagConfiguration(Definition $definition): ?ServiceTagConfiguration
    {
        $reflectionClass = new \ReflectionClass($definition->getClass());
        $annotationReader = new AnnotationReader();
        $annotation = $annotationReader->getClassAnnotation($reflectionClass, ServiceTag::class);

        return $annotation instanceof ServiceTag ? ServiceTagConfiguration::create($annotation) : null;
    }
}
