<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Configuration;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\AutoconfigureBundle\Tests\Resources\Decorator\DecorationWithInnerServicePropertyEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\Service\ServiceWithMethod;
use Symfony\Component\Console\Command\Command;

/**
 * Class ServiceWithMethodTest.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @TestConfig("container")
 *
 * @covers \RichId\AutoconfigureBundle\Annotation\AbstractServiceInjectionAnnotation
 * @covers \RichId\AutoconfigureBundle\Annotation\Method
 * @covers \RichId\AutoconfigureBundle\Configurators\Partials\AbstractServiceInjectionAutoConfigurator
 * @covers \RichId\AutoconfigureBundle\Configurators\Partials\MethodCallAutoConfigurator
 * @covers \RichId\AutoconfigureBundle\Configurators\ServiceAutoConfigurator
 * @covers \RichId\AutoconfigureBundle\Factory\Basics\AbstractAnnotationServiceConfigurationFactory
 * @covers \RichId\AutoconfigureBundle\Factory\Partials\MethodAnnotationServiceConfigurationFactory
 * @covers \RichId\AutoconfigureBundle\Factory\ServiceConfigurationFactory
 * @covers \RichId\AutoconfigureBundle\Model\ServiceConfiguration
 */
final class ServiceWithMethodTest extends TestCase
{
    public function testMethodServiceInjected(): void
    {
        $service = $this->getService(ServiceWithMethod::class);
        self::assertInstanceOf(DecorationWithInnerServicePropertyEventListener::class, $service->service);
    }

    public function testMethodParameterInjected(): void
    {
        $service = $this->getService(ServiceWithMethod::class);
        self::assertSame('This is a test', $service->parameter);
    }

    public function testMethodServicesByTagInjected(): void
    {
        $service = $this->getService(ServiceWithMethod::class);

        self::assertNotEmpty($service->commands);
        self::assertContainsOnlyInstancesOf(Command::class, $service->commands);
    }
}
