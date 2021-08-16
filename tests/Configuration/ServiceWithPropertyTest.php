<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Configuration;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\AutoconfigureBundle\Tests\Resources\Decorator\DecorationWithInnerServicePropertyEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\Service\ServiceWithProperty;

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
final class ServiceWithPropertyTest extends TestCase
{
    public function testPropertyServiceInjected(): void
    {
        $service = $this->getService(ServiceWithProperty::class);
        self::assertInstanceOf(DecorationWithInnerServicePropertyEventListener::class, $service->service);
    }

    public function testPropertyParameterInjected(): void
    {
        $service = $this->getService(ServiceWithProperty::class);
        self::assertSame('This is a test', $service->parameter);
    }
}
