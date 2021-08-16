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
 * @Service\Property("$service", DecorationWithInnerServicePropertyEventListener::class)
 * @Service\Property("parameter", "test_parameter", type="parameter")
 */
final class ServiceWithProperty
{
    /** @var DecorationWithInnerServicePropertyEventListener */
    public $service;

    /** @var string */
    public $parameter;
}
