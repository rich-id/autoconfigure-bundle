<?php declare(strict_types=1);

namespace RichId\TemplateBundle\Tests\Resources\Kernel;

use RichCongress\WebTestBundle\Kernel\DefaultTestKernel;

/**
 * Class TestKernel
 *
 * @package    RichId\TemplateBundle\Tests\Resources\Kernel
 * @author     Nicolas Guilloux <nicolas.guilloux@rich-id.fr>
 * @copyright  2014 - 2021 RichID (https://www.rich-id.fr)
 */
class TestKernel extends DefaultTestKernel
{
    public function __construct()
    {
        parent::__construct('test', false);
    }

    /**
     * @return string|null
     */
    public function getConfigurationDir(): ?string
    {
        return __DIR__ . '/config';
    }
}
