<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Definition;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichId\AutoconfigureBundle\Tests\Resources\Event\DummyEvent;
use RichId\AutoconfigureBundle\Tests\Resources\EventListener\ExplicitlyTaggedEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\EventListener\FromInterfaceEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\EventListener\NotAutoconfiguredEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\TestCase\DefinitionTestCase;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

/**
 * Class EventListenerAutoTagTest.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @TestConfig("container")
 *
 * @covers     \RichId\AutoconfigureBundle\Annotation\EventListener
 * @covers     \RichId\AutoconfigureBundle\Model\ServiceConfiguration
 * @covers     \RichId\AutoconfigureBundle\Factory\Partials\EventListenerServiceConfigurationFactory
 * @covers     \RichId\AutoconfigureBundle\Factory\Partials\TagAnnotationServiceConfigurationFactory
 * @covers     \RichId\AutoconfigureBundle\Factory\ServiceConfigurationFactory
 */
final class EventListenerAutoTagTest extends DefinitionTestCase
{
    /** @var EventDispatcherInterface */
    public $eventDispatcher;

    public function testExplicitlyTaggedEventListener(): void
    {
        $definition = self::getDefinition(ExplicitlyTaggedEventListener::class);
        $tags = $definition->getTags();

        self::assertArrayHasKey('kernel.event_listener', $tags);
        self::assertCount(1, $tags['kernel.event_listener']);

        $options = $tags['kernel.event_listener'][0];
        self::assertEquals(
            [
                'event'    => DummyEvent::class,
                'priority' => 10,
            ],
            $options
        );
    }

    public function testFromInterfaceEventListener(): void
    {
        $definition = self::getDefinition(FromInterfaceEventListener::class);
        $tags = $definition->getTags();

        self::assertArrayHasKey('kernel.event_listener', $tags);
        self::assertCount(1, $tags['kernel.event_listener']);

        $options = $tags['kernel.event_listener'][0];
        self::assertEquals([], $options);
    }

    public function testNotAutoConfigure(): void
    {
        $definition = self::getDefinition(NotAutoconfiguredEventListener::class);
        $tags = $definition->getTags();

        self::assertArrayNotHasKey('kernel.event_listener', $tags);
    }
}
