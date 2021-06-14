<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\AutoconfigureBundle\Tests\Resources\Decorator\DecorationWithInnerServiceConstructEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\Decorator\DecorationWithInnerServicePropertyEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\Decorator\DecorationWithInnerServiceSetterEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\EventListener\ExplicitlyTaggedEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\EventListener\FromInterfaceEventListener;

/**
 * Class DecorationTest.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @TestConfig("container")
 */
final class DecorationTest extends TestCase
{
    public function testDecoration(): void
    {
        $service = $this->getService(ExplicitlyTaggedEventListener::class);

        self::assertInstanceOf(DecorationWithInnerServiceConstructEventListener::class, $service);
    }

    public function testServiceInjectionInProperty(): void
    {
        $service = $this->getService(DecorationWithInnerServicePropertyEventListener::class);

        self::assertInstanceOf(FromInterfaceEventListener::class, $service->innerService);
    }

    public function testServiceInjectionInSetter(): void
    {
        $service = $this->getService(DecorationWithInnerServiceSetterEventListener::class);

        self::assertNotNull($service->getInnerService());
    }

    public function testServiceInjectionInConstructor(): void
    {
        $service = $this->getService(DecorationWithInnerServiceConstructEventListener::class);

        self::assertNotNull($service->getInnerService());
    }
}
