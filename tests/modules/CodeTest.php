<?php

declare(strict_types=1);

namespace Softspring\CmsModuleCollection\Test\Modules;

use Softspring\CmsBundle\Tests\ModuleTestCase;

class CodeTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName = 'code';
        $this->modulePath = realpath(__DIR__.'/../../modules/code');
    }

    public static function provideModuleRender(): array
    {
        return [
            'escaped code block' => [
                'data' => [
                    '_module' => 'code',
                    '_revision' => 1,
                    'id' => 'snippet',
                    'class' => 'mb-3',
                    'language' => 'php',
                    'code' => '<?php echo "Hello";',
                ],
                'expected' => function (string $result): void {
                    self::assertStringContainsString('id="snippet"', $result);
                    self::assertStringContainsString('class="sfs-code hljs p-2 mb-3"', $result);
                    self::assertStringContainsString('data-highlight-code', $result);
                    self::assertStringContainsString('data-language="php"', $result);
                    self::assertStringContainsString('&lt;?php echo &quot;Hello&quot;;', $result);
                },
            ],
        ];
    }
}
