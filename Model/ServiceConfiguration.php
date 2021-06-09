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
    /** @var string|null */
    private $decoratedService;

    /** @var array<string, array> */
    private $arguments = [];

    /** @var array<array> */
    private $tags = [];

    public function getDecoratedService(): ?string
    {
        return $this->decoratedService;
    }

    /** @return array[] */
    public function getTags(): array
    {
        return $this->tags;
    }

    /** @return array<string, array> */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function decorates(string $decoratedService): self
    {
        $this->decoratedService = $decoratedService;

        return $this;
    }

    public function addTag(array $options): self
    {
        $this->tags[] = $options;

        return $this;
    }

    public function setArgument(string $argument, array $options): self
    {
        $this->arguments[$argument] = $options;

        return $this;
    }
}
