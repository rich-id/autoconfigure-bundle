<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\AutoconfigureBundle\Tests\Resources\Event\DummyEvent;
use RichId\AutoconfigureBundle\Tests\Resources\EventListener\TaggedEventListener;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

/**
 * Class EventListenerAutoTagTest.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @TestConfig("container")
 *
 * @covers \RichId\AutoconfigureBundle\AutoTag\Annotation\EventListener
 */
final class EventListenerAutoTagTest extends TestCase
{
    /** @var EventDispatcherInterface */
    public $eventDispatcher;

    public function testTaggedEventListener(): void
    {
        $eventListener = $this->getService(TaggedEventListener::class);
        self::assertSame(0, $eventListener->count);

        $this->eventDispatcher->dispatch(new DummyEvent());
        self::assertSame(1, $eventListener->count);
    }
}
