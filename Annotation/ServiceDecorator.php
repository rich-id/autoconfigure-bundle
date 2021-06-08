<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Annotation;

/**
 * Class ServiceDecorator.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @Annotation({"CLASS"})
 */
class ServiceDecorator
{
    /** @var string */
    public $decorates;
}
