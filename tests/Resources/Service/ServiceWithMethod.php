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
 * @Service\Method("setValues", DecorationWithInnerServicePropertyEventListener::class)
 * @Service\Method("setValues", "test_parameter", type="parameter", position=1)
 * @Service\Method("setCommands", value="console.command", type="services_by_tag")
 */
final class ServiceWithMethod
{
    /** @var DecorationWithInnerServicePropertyEventListener */
    public $service;

    /** @var string */
    public $parameter;

    /** @var Command[] */
    public $commands;

    public function setValues(DecorationWithInnerServicePropertyEventListener $service, string $parameter): void
    {
        $this->service = $service;
        $this->parameter = $parameter;
    }

    /** @param Command[] $commands */
    public function setCommands(array $commands): self
    {
        $this->commands = $commands;

        return $this;
    }
}
