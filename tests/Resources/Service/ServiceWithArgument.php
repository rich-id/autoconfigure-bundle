<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Resources\Service;

use RichId\AutoconfigureBundle\Annotation as Service;
use RichId\AutoconfigureBundle\Tests\Resources\Decorator\DecorationWithInnerServicePropertyEventListener;
use Symfony\Component\Console\Command\Command;

/**
 * Class ServiceWithArgument.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @Service\Argument("service", DecorationWithInnerServicePropertyEventListener::class)
 * @Service\Argument("$parameter", "test_parameter", type="parameter")
 * @Service\Argument("commands", value="console.command", type="services_by_tag")
 */
final class ServiceWithArgument
{
    /** @var DecorationWithInnerServicePropertyEventListener */
    public $service;

    /** @var string */
    public $parameter;

    /** @var Command[] */
    public $commands;

    public function __construct($service, $parameter, $commands)
    {
        $this->service = $service;
        $this->parameter = $parameter;
        $this->commands = $commands;
    }
}
