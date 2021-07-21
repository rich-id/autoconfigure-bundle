<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Annotation;

/**
 * Class EventListener.
 *
 * Automatically tag an EventListener with the given options.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @Annotation({"CLASS"})
 */
#[\Attribute(\Attribute::IS_REPEATABLE | \Attribute::TARGET_CLASS)]
class EventListener extends Tag
{
    /** @var string */
    public $name = 'kernel.event_listener';

    /** @var string */
    public $event;

    /** @var int */
    public $priority;

    /** @var string */
    public $method;
}
