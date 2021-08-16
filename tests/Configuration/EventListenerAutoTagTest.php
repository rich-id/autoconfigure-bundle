<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Configuration;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\AutoconfigureBundle\Tests\Resources\Event\DummyEvent;
use RichId\AutoconfigureBundle\Tests\Resources\EventListener\ExplicitlyTaggedEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\EventListener\FromInterfaceEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\EventListener\NotAutoconfiguredEventListener;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

/**
 * Class EventListenerAutoTagTest.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @TestConfig("container")
 *
 * @covers \RichId\AutoconfigureBundle\Annotation\EventListener
 * @covers \RichId\AutoconfigureBundle\Model\ServiceConfiguration
 * @covers \RichId\AutoconfigureBundle\Factory\Partials\EventListenerServiceConfigurationFactory
 * @covers \RichId\AutoconfigureBundle\Factory\Partials\TagAnnotationServiceConfigurationFactory
 * @covers \RichId\AutoconfigureBundle\Factory\ServiceConfigurationFactory
 */
final class EventListenerAutoTagTest extends TestCase
{
    /** @var EventDispatcherInterface */
    public $eventDispatcher;

    public function testExplicitlyTaggedEventListener(): void
    {
        $eventListener = $this->getService(ExplicitlyTaggedEventListener::class);
        self::assertSame(0, $eventListener->count);

        $this->eventDispatcher->dispatch(new DummyEvent());
        self::assertSame(1, $eventListener->count);
    }

    public function testFromInterfaceEventListener(): void
    {
        $eventListener = $this->getService(FromInterfaceEventListener::class);
        self::assertSame(0, $eventListener->count);

        $this->eventDispatcher->dispatch(new DummyEvent());
        self::assertSame(1, $eventListener->count);
    }

    public function testNotAutoConfigure(): void
    {
        $eventListener = $this->getService(NotAutoconfiguredEventListener::class);
        self::assertSame(0, $eventListener->count);

        $this->eventDispatcher->dispatch(new DummyEvent());
        self::assertSame(0, $eventListener->count);
    }
}
