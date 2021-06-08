<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Resources\Decorator;

use RichId\AutoconfigureBundle\Annotation\ServiceDecorator;
use RichId\AutoconfigureBundle\Tests\Resources\EventListener\ExplicitlyTaggedEventListener;

/**
 * Class DecorationEventListener.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @ServiceDecorator(decorates=ExplicitlyTaggedEventListener::class)
 */
final class DecorationEventListener extends ExplicitlyTaggedEventListener
{
}
