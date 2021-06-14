<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Resources\Service;

use RichId\AutoconfigureBundle\Annotation as Service;
use RichId\AutoconfigureBundle\Tests\Resources\Decorator\DecorationWithInnerServicePropertyEventListener;

/**
 * Class ServiceWithArgument.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @Service\Argument("$service", DecorationWithInnerServicePropertyEventListener::class)
 * @Service\Argument("$parameter", "test_parameter", type="parameter")
 */
final class ServiceWithArgument
{
    /** @var DecorationWithInnerServicePropertyEventListener */
    public $service;

    /** @var string */
    public $parameter;

    public function __construct($service, $parameter)
    {
        $this->service = $service;
        $this->parameter = $parameter;
    }
}
