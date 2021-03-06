<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Annotation;

use Doctrine\Common\Annotations\Annotation\NamedArgumentConstructor;

/**
 * Class Decoration.
 *
 * Decorates the service and tries to inject the decorated service if the property `$innerService` is reachable.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @Annotation({"CLASS"})
 * @NamedArgumentConstructor()
 */
#[\Attribute(\Attribute::IS_REPEATABLE | \Attribute::TARGET_CLASS)]
class Decoration implements AutoconfigureAnnotation
{
    /** @var string */
    public $decorates;

    public function __construct(?string $decoratedService = null)
    {
        $this->decorates = $decoratedService;
    }
}
