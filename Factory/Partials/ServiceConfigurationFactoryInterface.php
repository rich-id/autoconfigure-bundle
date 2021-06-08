<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Factory\Partials;

use RichId\AutoconfigureBundle\Model\ServiceConfiguration;

/**
 * Interface ServiceConfigurationFactoryInterface.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
interface ServiceConfigurationFactoryInterface
{
    /** @return ServiceConfiguration[] */
    public function create(\ReflectionClass $reflectionClass): array;

    public function supports(\ReflectionClass $reflectionClass): bool;
}
