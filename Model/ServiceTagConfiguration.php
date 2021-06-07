<?php declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Model;

use RichId\AutoconfigureBundle\AutoTag\Annotation\ServiceTag;

/**
 * Class ServiceTagConfiguration
 *
 * @package    RichId\AutoconfigureBundle\Model
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class ServiceTagConfiguration
{
    /** @var string */
    public $name;

    /** @var array<string, mixed> */
    public $options = [];

    public static function create(ServiceTag $serviceTag): self
    {
        $configuration = new self();
        $configuration->options = $serviceTag->options;
        $reflectionClass = new \ReflectionClass($serviceTag);
        $reflectionProperties = $reflectionClass->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($reflectionProperties as $reflectionProperty) {
            $name = $reflectionProperty->getName();
            $value = $reflectionProperty->getValue($serviceTag);

            if ($name === 'options' || $value === null) {
                continue;
            }

            if ($name === 'name') {
                $configuration->name = $value;
                continue;
            }

            $configuration->options[$name] = $value;
        }

        return $configuration;
    }
}
