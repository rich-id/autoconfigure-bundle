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
final class Argument implements AutoconfigureAnnotation
{
    public const SERVICE_TYPE = 'service';
    public const PARAMETER_TYPE = 'parameter';

    /** @var string */
    public $argument;

    /** @var string */
    public $value;

    /** @var string */
    public $type;

    public function __construct(string $argument, string $value, string $type = self::SERVICE_TYPE)
    {
        $this->argument = $argument;
        $this->value = $value;
        $this->type = $type;
    }
}
