<?php

declare(strict_types=1);

namespace Softspring\CmsModuleCollection\Test\Modules;

use Softspring\CmsBundle\Tests\ModuleTestCase;

class EmbedVideoTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName = 'embed_video';
        $this->modulePath = realpath(__DIR__.'/../../modules/embed_video');
    }

    public static function provideModuleRender(): array
    {
        return [
            'raw embed code' => [
                'data' => [
                    '_module' => 'embed_video',
                    '_revision' => 1,
                    'id' => 'video',
                    'class' => 'ratio ratio-16x9',
                    'code' => '<iframe src="https://example.com/embed"></iframe>',
                ],
                'expected' => function (string $result): void {
                    self::assertStringContainsString('id="video"', $result);
                    self::assertStringContainsString('class="sfs-embed-video ratio ratio-16x9"', $result);
                    self::assertStringContainsString('<iframe src="https://example.com/embed"></iframe>', $result);
                },
            ],
        ];
    }
}
