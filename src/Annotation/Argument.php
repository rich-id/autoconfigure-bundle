<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Annotation;

use Doctrine\Common\Annotations\Annotation\NamedArgumentConstructor;

/**
 * Class Argument.
 *
 * Bind a service or a parameter to the designated argument.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @Annotation({"CLASS"})
 * @NamedArgumentConstructor()
 */
#[\Attribute(\Attribute::IS_REPEATABLE | \Attribute::TARGET_CLASS)]
final class Argument extends AbstractServiceInjectionAnnotation
{
    /** @var string */
    public $argument;

    public function __construct(string $argument, string $value, string $type = self::SERVICE_TYPE)
    {
        parent::__construct($value, $type);

        $this->argument = $argument;
    }
}
