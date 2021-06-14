<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Model;

/**
 * Class ServiceConfiguration.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 */
final class ServiceConfiguration
{
    /** @var \ReflectionClass */
    private $targetClass;

    /** @var string|null */
    private $decoratedService;

    /** @var array<string, array> */
    private $properties = [];

    /** @var array<string, array> */
    private $arguments = [];

    /** @var array<string, array> */
    private $methodCalls = [];

    /** @var array<array> */
    private $tags = [];

    public function __construct(\ReflectionClass $targetClass)
    {
        $this->targetClass = $targetClass;
    }

    public function getTargetClass(): \ReflectionClass
    {
        return $this->targetClass;
    }

    public function getDecoratedService(): ?string
    {
        return $this->decoratedService;
    }

    /** @return array<string, array> */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /** @return array<string, array> */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /** @return array[] */
    public function getMethodCalls(): array
    {
        return $this->methodCalls;
    }

    /** @return array[] */
    public function getTags(): array
    {
        return $this->tags;
    }

    public function decorates(string $decoratedService): self
    {
        $this->decoratedService = $decoratedService;

        return $this;
    }

    public function setProperty(string $property, array $options): self
    {
        $this->properties[$property] = $options;

        return $this;
    }

    public function setArgument(string $argument, array $options): self
    {
        $this->arguments[$argument] = $options;

        return $this;
    }

    public function addMethodCall(string $method, array $arguments): self
    {
        $this->methodCalls[$method] = $arguments;

        return $this;
    }

    public function addTag(array $options): self
    {
        $this->tags[] = $options;

        return $this;
    }
}
