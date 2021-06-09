<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Resources\Service;

use RichId\AutoconfigureBundle\Annotation\ServiceArgument;
use RichId\AutoconfigureBundle\Tests\Resources\Decorator\DecorationEventListener;

/**
 * Class ServiceWithArgument.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @ServiceArgument("$service", DecorationEventListener::class)
 * @ServiceArgument("$parameter", "test_parameter", type="parameter")
 */
final class ServiceWithArgument
{
    /** @var DecorationEventListener */
    public $service;

    /** @var string */
    public $parameter;

    public function __construct($service, $parameter)
    {
        $this->service = $service;
        $this->parameter = $parameter;
    }
}
