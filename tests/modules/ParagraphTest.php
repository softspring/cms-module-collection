<?php

declare(strict_types=1);

namespace Softspring\CmsModuleCollection\Test\Modules;

use Softspring\CmsBundle\Tests\ModuleTestCase;

class ParagraphTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName = 'paragraph';
        $this->modulePath = realpath(__DIR__.'/../../modules/paragraph');
    }

    public static function provideModuleRender(): array
    {
        return [
            'translated paragraph' => [
                'data' => [
                    '_module' => 'paragraph',
                    '_revision' => 1,
                    'id' => 'intro',
                    'class' => 'lead',
                    'paragraph' => [
                        'en' => 'Intro text',
                    ],
                ],
                'expected' => function (string $result): void {
                    self::assertStringContainsString('<p', $result);
                    self::assertStringContainsString('id="intro"', $result);
                    self::assertStringContainsString('class="sfs-paragraph lead"', $result);
                    self::assertStringContainsString('>Intro text</p>', $result);
                },
            ],
        ];
    }
}
