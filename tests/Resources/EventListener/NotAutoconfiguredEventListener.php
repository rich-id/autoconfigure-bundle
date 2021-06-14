<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Resources\EventListener;

use RichId\AutoconfigureBundle\Tests\Resources\Event\DummyEvent;

/**
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
class NotAutoconfiguredEventListener
{
    /** @var int */
    public $count = 0;

    public function __invoke(DummyEvent $event): void
    {
        $this->count++;
    }
}
