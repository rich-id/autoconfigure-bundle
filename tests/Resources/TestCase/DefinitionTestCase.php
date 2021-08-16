<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Resources\TestCase;

use RichCongress\TestSuite\TestCase\TestCase;
use RichId\AutoconfigureBundle\Configurators\ServiceAutoConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

abstract class DefinitionTestCase extends TestCase
{
    protected static function getDefinition(string $class): Definition
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->setParameter('test_parameter', 'This is a test');
        $definition = new Definition($class);
        ServiceAutoConfigurator::autoconfigure($containerBuilder, $definition);

        return $definition;
    }
}
