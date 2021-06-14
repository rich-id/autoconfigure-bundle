<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Configurators\Partials;

use RichId\AutoconfigureBundle\Configurators\Basics\ServiceAutoConfiguratorInterface;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Class TagAutoConfigurator.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class TagAutoConfigurator implements ServiceAutoConfiguratorInterface
{
    public function autoconfigure(
        Container $container,
        Definition $definition,
        ServiceConfiguration $configuration
    ): void {
        foreach ($configuration->getTags() as $tagOptions) {
            $name = $tagOptions['name'];
            unset($tagOptions['name']);

            $definition->addTag($name, $tagOptions);
        }
    }
}
