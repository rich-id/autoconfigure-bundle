<?php declare(strict_types=1);

namespace RichId\AutoconfigureBundle\AutoTag\Annotation;

/**
 * Class ServiceTag
 *
 * @package    RichId\AutoconfigureBundle\AutoTag\Annotation
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @Annotation({"CLASS"})
 */
class ServiceTag
{
    /** @var string */
    public $name;

    /** @var array<string, mixed> */
    public $options = [];
}
