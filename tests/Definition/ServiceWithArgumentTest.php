<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Definition;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichId\AutoconfigureBundle\Tests\Resources\Decorator\DecorationWithInnerServicePropertyEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\Service\ServiceWithArgument;
use RichId\AutoconfigureBundle\Tests\Resources\TestCase\DefinitionTestCase;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ServiceWithArgumentTest.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @TestConfig("container")
 *
 * @covers \RichId\AutoconfigureBundle\Annotation\Argument
 * @covers \RichId\AutoconfigureBundle\Configurators\Partials\ArgumentAutoConfigurator
 * @covers \RichId\AutoconfigureBundle\Configurators\ServiceAutoConfigurator
 * @covers \RichId\AutoconfigureBundle\Factory\Basics\AbstractAnnotationServiceConfigurationFactory
 * @covers \RichId\AutoconfigureBundle\Factory\Partials\ArgumentAnnotationServiceConfigurationFactory
 * @covers \RichId\AutoconfigureBundle\Factory\ServiceConfigurationFactory
 * @covers \RichId\AutoconfigureBundle\Model\ServiceConfiguration
 */
final class ServiceWithArgumentTest extends DefinitionTestCase
{
    public function testArgumentServiceInjected(): void
    {
        $definition = self::getDefinition(ServiceWithArgument::class);
        $arguments = $definition->getArguments();

        self::assertArrayHasKey('$service', $arguments);
        self::assertInstanceOf(Reference::class, $arguments['$service']);
        self::assertSame(DecorationWithInnerServicePropertyEventListener::class, (string) $arguments['$service']);
    }

    public function testArgumentParameterInjected(): void
    {
        $definition = self::getDefinition(ServiceWithArgument::class);
        $arguments = $definition->getArguments();

        self::assertArrayHasKey('$parameter', $arguments);
        self::assertSame('This is a test', $arguments['$parameter']);
    }
}
