<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Definition;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichId\AutoconfigureBundle\Tests\Resources\Decorator\DecorationWithInnerServiceConstructEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\Decorator\DecorationWithInnerServicePropertyEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\Decorator\DecorationWithInnerServiceSetterEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\EventListener\ExplicitlyTaggedEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\TestCase\DefinitionTestCase;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class DecorationTest.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @TestConfig("container")
 *
 * @covers \RichId\AutoconfigureBundle\Annotation\Decoration
 * @covers \RichId\AutoconfigureBundle\Configurators\Partials\DecorationAutoConfigurator
 * @covers \RichId\AutoconfigureBundle\Configurators\ServiceAutoConfigurator
 * @covers \RichId\AutoconfigureBundle\Factory\Partials\DecorationAnnotationServiceConfigurationFactory
 * @covers \RichId\AutoconfigureBundle\Factory\ServiceConfigurationFactory
 * @covers \RichId\AutoconfigureBundle\Model\ServiceConfiguration
 */
final class DecorationTest extends DefinitionTestCase
{
    public function testDecoration(): void
    {
        $definition = self::getDefinition(DecorationWithInnerServiceConstructEventListener::class);

        self::assertContains(ExplicitlyTaggedEventListener::class, $definition->getDecoratedService());
    }

    public function testServiceInjectionInProperty(): void
    {
        $definition = self::getDefinition(DecorationWithInnerServicePropertyEventListener::class);
        $properties = $definition->getProperties();

        self::assertArrayHasKey('innerService', $properties);
        self::assertInstanceOf(Reference::class, $properties['innerService']);
        self::assertSame(DecorationWithInnerServicePropertyEventListener::class . '.inner', (string) $properties['innerService']);
    }

    public function testServiceInjectionInSetter(): void
    {
        $definition = self::getDefinition(DecorationWithInnerServiceSetterEventListener::class);
        $methodCalls = $definition->getMethodCalls();

        self::assertCount(1, $methodCalls);
        self::assertCount(2, $methodCalls[0]);

        $method = $methodCalls[0][0];
        self::assertSame('setInnerService', $method);

        $arguments = $methodCalls[0][1];
        self::assertCount(1, $arguments);
        self::assertInstanceOf(Reference::class, $arguments[0]);
        self::assertSame(DecorationWithInnerServiceSetterEventListener::class . '.inner', (string) $arguments[0]);
    }

    public function testServiceInjectionInConstructor(): void
    {
        $definition = self::getDefinition(DecorationWithInnerServiceConstructEventListener::class);
        $arguments = $definition->getArguments();

        self::assertArrayHasKey('$innerService', $arguments);
        self::assertInstanceOf(Reference::class, $arguments['$innerService']);
        self::assertSame(DecorationWithInnerServiceConstructEventListener::class . '.inner', (string) $arguments['$innerService']);
    }
}
