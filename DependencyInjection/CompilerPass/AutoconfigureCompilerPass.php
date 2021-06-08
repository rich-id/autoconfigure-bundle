<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\DependencyInjection\CompilerPass;

use RichCongress\BundleToolbox\Configuration\AbstractCompilerPass;
use RichId\AutoconfigureBundle\Factory\ServiceConfigurationFactory;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;
use Symfony\Component\Cache\Psr16Cache;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class AutoconfigureCompilerPass.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
class AutoconfigureCompilerPass extends AbstractCompilerPass
{
    public const PRIORITY = 51;
    public const CLASSES_TO_SKIP = [Psr16Cache::class];

    public function process(ContainerBuilder $container): void
    {
        $taggedServices = $container->getDefinitions();

        foreach ($taggedServices as $serviceId => $tags) {
            $definition = $container->findDefinition($serviceId);
            $class = $definition->getClass();

            if ($definition->isAbstract() || $definition->isSynthetic() || \in_array($class, self::CLASSES_TO_SKIP, true)) {
                continue;
            }

            try {
                $reflectionClass = new \ReflectionClass($class);
                $configurations = ServiceConfigurationFactory::create($reflectionClass);

                foreach ($configurations as $configuration) {
                    $this->configure($definition, $configuration);
                }
            } catch (\Throwable $e) {
                // Skip if it fails to get class information
            }
        }
    }

    private function configure(Definition $definition, ServiceConfiguration $configuration): void
    {
        $class = $definition->getClass();
        $reflectionClass = new \ReflectionClass($class);

        if ($configuration->getDecoratedService() !== null) {
            $definition->setDecoratedService($configuration->getDecoratedService());

            if ($reflectionClass->hasMethod('setInnerService')) {
                $innerService = $class . '.inner';
                $definition->addMethodCall('setInnerService', [new Reference($innerService)]);
            }
        }

        foreach ($configuration->getTags() as $tagOptions) {
            $name = $tagOptions['name'];
            unset($tagOptions['name']);

            $definition->addTag($name, $tagOptions);
        }
    }
}
