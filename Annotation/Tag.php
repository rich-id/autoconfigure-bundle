<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Annotation;

use Doctrine\ORM\Mapping\Annotation;

/**
 * Class Tag.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @Annotation({"CLASS"})
 */
class Tag implements Annotation
{
    /** @var string */
    public $name;

    /** @var array<string, mixed> */
    public $options = [];
}
