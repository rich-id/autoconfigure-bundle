<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Annotation;

use Doctrine\Common\Annotations\Annotation\NamedArgumentConstructor;

/**
 * Class Method.
 *
 * Bind a service or a parameter to the designated method.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @Annotation({"CLASS"})
 * @NamedArgumentConstructor()
 */
#[\Attribute(\Attribute::IS_REPEATABLE | \Attribute::TARGET_CLASS)]
final class Method extends AbstractServiceInjectionAnnotation
{
    /** @var string */
    public $method;

    /** @var int */
    public $position = 0;

    public function __construct(string $method, string $value, string $type = self::SERVICE_TYPE, int $position = 0)
    {
        parent::__construct($value, $type);

        $this->method = $method;
        $this->position = $position;
    }
}
