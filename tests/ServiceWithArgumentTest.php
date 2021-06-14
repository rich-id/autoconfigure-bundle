<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\AutoconfigureBundle\Tests\Resources\Decorator\DecorationWithInnerServicePropertyEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\Service\ServiceWithArgument;

/**
 * Class ServiceWithArgumentTest.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @TestConfig("container")
 */
final class ServiceWithArgumentTest extends TestCase
{
    public function testArgumentServiceInjected(): void
    {
        $service = $this->getService(ServiceWithArgument::class);
        self::assertInstanceOf(DecorationWithInnerServicePropertyEventListener::class, $service->service);
    }

    public function testArgumentParameterInjected(): void
    {
        $service = $this->getService(ServiceWithArgument::class);
        self::assertSame('This is a test', $service->parameter);
    }
}
