<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Configurators\Partials;

use RichId\AutoconfigureBundle\Model\ServiceConfiguration;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Class MethodCallAutoConfigurator.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class MethodCallAutoConfigurator extends AbstractServiceInjectionAutoConfigurator
{
    public function autoconfigure(
        ContainerBuilder $container,
        Definition $definition,
        ServiceConfiguration $configuration
    ): void {
        foreach ($configuration->getMethodCalls() as $method => $arguments) {
            $resolvedArguments = $this->findMethodCallExistingArguments($definition, $method);

            foreach ($arguments as $key => $value) {
                $resolvedArguments[$key] = $this->resolveObject($container, $value);
            }

            $this->setMethodCall($definition, $method, $resolvedArguments);
        }
    }

    private function findMethodCallExistingArguments(Definition $definition, string $method): array
    {
        foreach ($definition->getMethodCalls() as $data) {
            if ($data[0] === $method) {
                return $data[1] ?? [];
            }
        }

        return [];
    }

    private function setMethodCall(Definition $definition, string $method, array $arguments): void
    {
        $methodCalls = $definition->getMethodCalls();

        foreach ($methodCalls as $key => $data) {
            if ($data[0] === $method) {
                $methodCalls[$key] = [$method, $arguments];
                $definition->setMethodCalls($methodCalls);

                return;
            }
        }

        $definition->addMethodCall($method, $arguments);
    }
}
