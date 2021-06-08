<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle\Tests;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\AutoconfigureBundle\Tests\Resources\Decorator\DecorationEventListener;
use RichId\AutoconfigureBundle\Tests\Resources\EventListener\ExplicitlyTaggedEventListener;

/**
 * Class DecorationTest.
 *
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 Rich ID (https://www.rich-id.fr)
 *
 * @TestConfig("container")
 */
final class DecorationTest extends TestCase
{
    public function testDecoration(): void
    {
        $service = $this->getService(ExplicitlyTaggedEventListener::class);

        self::assertInstanceOf(DecorationEventListener::class, $service);
    }
}
