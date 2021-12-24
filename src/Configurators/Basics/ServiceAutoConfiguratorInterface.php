<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Configurators\Basics;

use RichId\AutoconfigureBundle\Model\ServiceConfiguration;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Interface ServiceAutoConfiguratorInterface.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
interface ServiceAutoConfiguratorInterface
{
    public function autoconfigure(
        ContainerBuilder $container,
        Definition $definition,
        ServiceConfiguration $configuration
    ): void;
}
