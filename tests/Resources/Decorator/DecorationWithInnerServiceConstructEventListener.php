<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Resources\Decorator;

use RichId\AutoconfigureBundle\Annotation as Service;
use RichId\AutoconfigureBundle\Tests\Resources\EventListener\ExplicitlyTaggedEventListener;

/**
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
#[Service\Decoration(ExplicitlyTaggedEventListener::class)]
final class DecorationWithInnerServiceConstructEventListener extends ExplicitlyTaggedEventListener
{
    /** @var ExplicitlyTaggedEventListener */
    private $innerService;

    public function __construct($innerService = null)
    {
        $this->innerService = $innerService;
    }

    public function getInnerService(): ?ExplicitlyTaggedEventListener
    {
        return $this->innerService;
    }
}
