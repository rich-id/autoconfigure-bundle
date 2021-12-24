<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Definition;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichId\AutoconfigureBundle\Tests\Resources\Decorator\DecorationWithInnerServicePropertyEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\Service\ServiceWithMethod;
use RichId\AutoconfigureBundle\Tests\Resources\TestCase\DefinitionTestCase;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ServiceWithMethodTest.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @TestConfig("container")
 *
 * @covers     \RichId\AutoconfigureBundle\Annotation\AbstractServiceInjectionAnnotation
 * @covers     \RichId\AutoconfigureBundle\Annotation\Method
 * @covers     \RichId\AutoconfigureBundle\Configurators\Partials\AbstractServiceInjectionAutoConfigurator
 * @covers     \RichId\AutoconfigureBundle\Configurators\Partials\MethodCallAutoConfigurator
 * @covers     \RichId\AutoconfigureBundle\Configurators\ServiceAutoConfigurator
 * @covers     \RichId\AutoconfigureBundle\Factory\Basics\AbstractAnnotationServiceConfigurationFactory
 * @covers     \RichId\AutoconfigureBundle\Factory\Partials\MethodAnnotationServiceConfigurationFactory
 * @covers     \RichId\AutoconfigureBundle\Factory\ServiceConfigurationFactory
 * @covers     \RichId\AutoconfigureBundle\Model\ServiceConfiguration
 */
final class ServiceWithMethodTest extends DefinitionTestCase
{
    public function testMethodServiceInjected(): void
    {
        $definition = self::getDefinition(ServiceWithMethod::class);
        $methodsCalls = $this->getMethodCalls($definition);

        self::assertArrayHasKey('setValues', $methodsCalls);
        self::assertInstanceOf(Reference::class, $methodsCalls['setValues'][0]);
        self::assertSame(DecorationWithInnerServicePropertyEventListener::class, (string) $methodsCalls['setValues'][0]);
    }

    public function testMethodParameterInjected(): void
    {
        $definition = self::getDefinition(ServiceWithMethod::class);
        $methodsCalls = $this->getMethodCalls($definition);

        self::assertArrayHasKey('setValues', $methodsCalls);
        self::assertSame('This is a test', $methodsCalls['setValues'][1]);
    }

    public function testMethodServicesByTagInjected(): void
    {
        $definition = self::getDefinition(ServiceWithMethod::class);
        $methodsCalls = $this->getMethodCalls($definition);

        self::assertArrayHasKey('setCommands', $methodsCalls);
        self::assertCount(1, $methodsCalls['setCommands']);
        self::assertIsArray($methodsCalls['setCommands'][0]);
        self::assertCount(1, $methodsCalls['setCommands'][0]);
        self::assertSame('random_command', (string) $methodsCalls['setCommands'][0][0]);
    }

    private function getMethodCalls(Definition $definition): array
    {
        $methodsCalls = [];

        foreach ($definition->getMethodCalls() as $data) {
            $methodsCalls[$data[0]] = $data[1];
        }

        return $methodsCalls;
    }
}
