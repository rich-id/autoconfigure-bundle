<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Configurators\Partials;

use RichId\AutoconfigureBundle\Configurators\Basics\ServiceAutoConfiguratorInterface;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Class DecorationAutoConfigurator.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class DecorationAutoConfigurator implements ServiceAutoConfiguratorInterface
{
    public function autoconfigure(
        Container $container,
        Definition $definition,
        ServiceConfiguration $configuration
    ): void {
        if ($configuration->getDecoratedService() === null) {
            return;
        }

        $definition->setDecoratedService($configuration->getDecoratedService());
    }
}
