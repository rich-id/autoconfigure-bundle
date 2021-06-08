<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Annotation;

/**
 * Class EventListener.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @Annotation({"CLASS"})
 */
class EventListener extends ServiceTag
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
