<?php

declare(strict_types=1);

namespace Softspring\CmsModuleCollection\Test\Modules;

use Softspring\CmsBundle\Tests\ModuleTestCase;

abstract class MediaModuleTestCase extends ModuleTestCase
{
    public function testModuleForm(): void
    {
        $this->markTestSkipped('Media module form fields require MediaModalType integration services.');
    }
}
