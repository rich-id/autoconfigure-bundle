<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Annotation;

abstract class AbstractServiceInjectionAnnotation implements AutoconfigureAnnotation
{
    public const SERVICE_TYPE = 'service';
    public const PARAMETER_TYPE = 'parameter';
    public const SERVICES_BY_TAG = 'services_by_tag';

    /** @var string */
    public $value;

    /** @var string */
    public $type;

    public function __construct(string $value, string $type = self::SERVICE_TYPE)
    {
        $this->value = $value;
        $this->type = $type;
    }
}
