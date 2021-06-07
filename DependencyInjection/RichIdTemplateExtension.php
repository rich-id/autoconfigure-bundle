<?php declare(strict_types=1);

namespace RichId\TemplateBundle\DependencyInjection;

use RichCongress\BundleToolbox\Configuration\AbstractExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class RichIdTemplateExtension extends AbstractExtension
{
    /**
     * @param array<string, mixed> $configs
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $this->parseConfiguration(
            $container,
            new Configuration(),
            $configs
        );

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources'));
        $loader->load('services.xml');
    }
}
