<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Resources\EventListener;

use RichId\AutoconfigureBundle\Annotation as Service;
use RichId\AutoconfigureBundle\Tests\Resources\Event\DummyEvent;

/**
 * Class ExplicitlyTaggedEventListener.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @Service\EventListener(event=DummyEvent::class, priority=10)
 */
class ExplicitlyTaggedEventListener
{
    /** @var int */
    public $count = 0;

    public function __invoke(DummyEvent $event): void
    {
        ++$this->count;
    }
}
