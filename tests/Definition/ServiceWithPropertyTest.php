<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Definition;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichId\AutoconfigureBundle\Tests\Resources\Decorator\DecorationWithInnerServicePropertyEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\Service\ServiceWithProperty;
use RichId\AutoconfigureBundle\Tests\Resources\TestCase\DefinitionTestCase;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ServiceWithPropertyTest.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @TestConfig("container")
 *
 * @covers \RichId\AutoconfigureBundle\Annotation\Property
 * @covers \RichId\AutoconfigureBundle\Configurators\Partials\PropertyAutoConfigurator
 * @covers \RichId\AutoconfigureBundle\Configurators\ServiceAutoConfigurator
 * @covers \RichId\AutoconfigureBundle\Factory\Basics\AbstractAnnotationServiceConfigurationFactory
 * @covers \RichId\AutoconfigureBundle\Factory\Partials\PropertyAnnotationServiceConfigurationFactory
 * @covers \RichId\AutoconfigureBundle\Factory\ServiceConfigurationFactory
 * @covers \RichId\AutoconfigureBundle\Model\ServiceConfiguration
 */
final class ServiceWithPropertyTest extends DefinitionTestCase
{
    public function testArgumentServiceInjected(): void
    {
        $definition = self::getDefinition(ServiceWithProperty::class);
        $properties = $definition->getProperties();

        self::assertArrayHasKey('service', $properties);
        self::assertInstanceOf(Reference::class, $properties['service']);
        self::assertSame(DecorationWithInnerServicePropertyEventListener::class, (string) $properties['service']);
    }

    public function testArgumentParameterInjected(): void
    {
        $definition = self::getDefinition(ServiceWithProperty::class);
        $properties = $definition->getProperties();

        self::assertArrayHasKey('parameter', $properties);
        self::assertSame('This is a test', $properties['parameter']);
    }

    public function testArgumentServicesByTagInjected(): void
    {
        $definition = self::getDefinition(ServiceWithProperty::class);
        $properties = $definition->getProperties();

        self::assertArrayHasKey('commands', $properties);
        self::assertIsArray($properties['commands']);
        self::assertCount(1, $properties['commands']);
        self::assertSame('random_command', (string) $properties['commands'][0]);
    }
}
