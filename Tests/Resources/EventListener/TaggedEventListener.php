<?php declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Resources\EventListener;

use RichId\AutoconfigureBundle\AutoTag\Annotation\EventListener;
use RichId\AutoconfigureBundle\AutoTag\AutoconfigureServiceInterface;
use RichId\AutoconfigureBundle\Tests\Resources\Event\DummyEvent;

/**
 * Class TaggedEventListener
 *
 * @package    RichId\AutoconfigureBundle\Tests\Resources\EventListener
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @EventListener(event=\RichId\AutoconfigureBundle\Tests\Resources\Event\DummyEvent::class, priority=10)
 */
final class TaggedEventListener implements AutoconfigureServiceInterface
{
    /** @var int */
    public $count = 0;

    public function __invoke(DummyEvent $event): void
    {
        $this->count++;
    }
}
