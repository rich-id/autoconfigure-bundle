<?php declare(strict_types=1);

namespace RichId\AutoconfigureBundle\DependencyInjection;

use RichCongress\BundleToolbox\Configuration\AbstractConfiguration;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;

class Configuration extends AbstractConfiguration
{
    public const CONFIG_NODE = 'rich_id_autoconfigure';

    protected function buildConfiguration(ArrayNodeDefinition $rootNode): void
    {
        $children = $rootNode->children();
        $this->buildConfig($children);
        $children->end();
    }

    protected function buildConfig(NodeBuilder $nodeBuilder): void
    {
        // Do something
    }
}
