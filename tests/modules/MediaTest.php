<?php

declare(strict_types=1);

namespace Softspring\CmsModuleCollection\Test\Modules;

class MediaTest extends MediaModuleTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName = 'media';
        $this->modulePath = realpath(__DIR__.'/../../modules/media');
    }

    public static function provideModuleRender(): array
    {
        return [
            'media render requires a media object' => [
                'data' => [],
                'expected' => '',
            ],
        ];
    }

    public function testRender(array $data = [], string|callable $expected = '', array $templatesSource = []): void
    {
        $this->markTestSkipped('Media rendering requires MediaBundle renderer integration.');
    }
}
