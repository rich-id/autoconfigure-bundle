<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Resources\Decorator;

use RichId\AutoconfigureBundle\Annotation as Service;
use RichId\AutoconfigureBundle\Tests\Resources\EventListener\NotAutoconfiguredEventListener;

/**
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @Service\Decoration(NotAutoconfiguredEventListener::class)
 */
final class DecorationWithInnerServiceSetterEventListener extends NotAutoconfiguredEventListener
{
    /** @var NotAutoconfiguredEventListener */
    private $innerService;

    public function getInnerService(): ?NotAutoconfiguredEventListener
    {
        return $this->innerService;
    }

    public function setInnerService(NotAutoconfiguredEventListener $innerService): self
    {
        $this->innerService = $innerService;

        return $this;
    }
}
