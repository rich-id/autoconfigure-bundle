<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Resources\Decorator;

use RichId\AutoconfigureBundle\Annotation as Service;
use RichId\AutoconfigureBundle\Tests\Resources\EventListener\FromInterfaceEventListener;

/**
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @Service\Decoration(FromInterfaceEventListener::class)
 */
final class DecorationWithInnerServicePropertyEventListener extends FromInterfaceEventListener
{
    /** @var FromInterfaceEventListener */
    public $innerService;
}
