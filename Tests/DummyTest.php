<?php declare(strict_types=1);

namespace RichId\TemplateBundle\Tests;

use RichCongress\TestTools\TestCase\TestCase;
use RichId\TemplateBundle\RichIdTemplateBundle;

/**
 * Class DummyTest
 *
 * @package   RichId\TemplateBundle\Tests
 * @author    Nicolas Guilloux <nguilloux@rich-id.com>
 * @copyright 2014 - 2020 RichId (https://www.rich-id.com)
 *
 * @covers \RichId\TemplateBundle\RichIdTemplateBundle
 */
class DummyTest extends TestCase
{
    public function testInstanciateBundle(): void
    {
        $bundle = new RichIdTemplateBundle();

        self::assertInstanceOf(RichIdTemplateBundle::class, $bundle);
    }
}
