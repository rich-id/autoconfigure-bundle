<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests\Definition;

use RichCongress\TestSuite\TestCase\TestCase;
use RichId\AutoconfigureBundle\Configurators\Partials\ArgumentAutoConfigurator;
use RichId\AutoconfigureBundle\Configurators\ServiceAutoConfigurator;
use RichId\AutoconfigureBundle\Model\ServiceConfiguration;
use Symfony\Component\Cache\Psr16Cache;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * @covers \RichId\AutoconfigureBundle\Configurators\Partials\AbstractServiceInjectionAutoConfigurator
 */
final class AutoConfiguratorTest extends TestCase
{
    public function testSkippedAbstract(): void
    {
        $definition = new Definition();
        $definition->setAbstract(true);
        ServiceAutoConfigurator::autoconfigure(new ContainerBuilder(), $definition);

        self::assertEmpty($definition->getProperties());
        self::assertEmpty($definition->getArguments());
        self::assertEmpty($definition->getMethodCalls());
    }

    public function testSkippedSynthetic(): void
    {
        $definition = new Definition();
        $definition->setSynthetic(true);
        ServiceAutoConfigurator::autoconfigure(new ContainerBuilder(), $definition);

        self::assertEmpty($definition->getProperties());
        self::assertEmpty($definition->getArguments());
        self::assertEmpty($definition->getMethodCalls());
    }

    public function testSkippedClass(): void
    {
        $definition = new Definition();
        $definition->setClass(Psr16Cache::class);
        ServiceAutoConfigurator::autoconfigure(new ContainerBuilder(), $definition);

        self::assertEmpty($definition->getProperties());
        self::assertEmpty($definition->getArguments());
        self::assertEmpty($definition->getMethodCalls());
    }

    public function testUnsupportedType(): void
    {
        $autoConfigurator = new ArgumentAutoConfigurator();
        $reflectionClass = new \ReflectionClass($this);
        $configuration = new ServiceConfiguration($reflectionClass);
        $configuration->setArgument('test', [
            'type'  => 'unsupported',
            'value' => 'test',
        ]);

        $this->expectException(\UnexpectedValueException::class);
        $this->expectErrorMessage('The type used a service configuration is wrong.');

        $autoConfigurator->autoconfigure(
            new ContainerBuilder(),
            new Definition(),
            $configuration
        );
    }
}
