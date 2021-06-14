<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Annotation;

use Doctrine\ORM\Mapping\Annotation;

/**
 * Class Tag.
 *
 * Attach a tag to the service. The name of the tag is required, the options are optionals.
 * You may want to create your own tag by extending this class and declare explicitly all properties that will be
 * mapped into the options. Checkout the `EventListener` annotation to see an example.
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
