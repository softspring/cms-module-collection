<?php

declare(strict_types=1);

namespace Softspring\CmsModuleCollection\Test\Modules;

use Softspring\CmsBundle\Tests\ModuleTestCase;

class WysiwygTranslatableTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName = 'wysiwyg_translatable';
        $this->modulePath = realpath(__DIR__.'/../../modules/wysiwyg_translatable');
    }

    public static function provideModuleRender(): array
    {
        return [
            'translated html content' => [
                'data' => [
                    '_module' => 'wysiwyg_translatable',
                    '_revision' => 2,
                    'id' => 'translated-body',
                    'class' => 'rich-text',
                    'html_content' => [
                        'en' => '<p><strong>Translated</strong> body</p>',
                    ],
                ],
                'expected' => function (string $result): void {
                    self::assertStringContainsString('id="translated-body"', $result);
                    self::assertStringContainsString('class="sfs-wysiwyg-trans rich-text"', $result);
                    self::assertStringContainsString('<p><strong>Translated</strong> body</p>', $result);
                },
            ],
        ];
    }

    protected function provideDataForMigrations(): array
    {
        return [
            [
                '_revision' => 1,
                'id' => 'translated-body',
                'class' => 'rich-text',
                'content' => [
                    'en' => '<p>Old content</p>',
                ],
            ],
            [
                '_revision' => 2,
                'id' => 'translated-body',
                'class' => 'rich-text',
                'html_content' => [
                    'en' => '<p>Old content</p>',
                ],
            ],
        ];
    }
}
