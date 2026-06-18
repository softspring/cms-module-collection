<?php

declare(strict_types=1);

namespace Softspring\CmsModuleCollection\Test\Modules;

use Softspring\CmsBundle\Tests\ModuleTestCase;

class WysiwygTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName = 'wysiwyg';
        $this->modulePath = realpath(__DIR__.'/../../modules/wysiwyg');
    }

    public static function provideModuleRender(): array
    {
        return [
            'html content' => [
                'data' => [
                    '_module' => 'wysiwyg',
                    '_revision' => 2,
                    'id' => 'body',
                    'class' => 'rich-text',
                    'html_content' => '<p><strong>Body</strong> text</p>',
                ],
                'expected' => function (string $result): void {
                    self::assertStringContainsString('id="body"', $result);
                    self::assertStringContainsString('class="sfs-wysiwyg rich-text"', $result);
                    self::assertStringContainsString('<p><strong>Body</strong> text</p>', $result);
                },
            ],
        ];
    }

    protected function provideDataForMigrations(): array
    {
        return [
            [
                '_revision' => 1,
                'id' => 'body',
                'class' => 'rich-text',
                'content' => '<p>Old content</p>',
            ],
            [
                '_revision' => 2,
                'id' => 'body',
                'class' => 'rich-text',
                'html_content' => '<p>Old content</p>',
            ],
        ];
    }
}
