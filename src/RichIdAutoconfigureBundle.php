<?php

declare(strict_types=1);

namespace RichId\AutoconfigureBundle;

use RichCongress\BundleToolbox\Configuration\AbstractBundle;
use RichId\AutoconfigureBundle\DependencyInjection\CompilerPass\AutoconfigureCompilerPass;

class RichIdAutoconfigureBundle extends AbstractBundle
{
    public const COMPILER_PASSES = [AutoconfigureCompilerPass::class];
}
