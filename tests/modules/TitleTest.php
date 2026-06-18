<?php

declare(strict_types=1);

namespace Softspring\CmsModuleCollection\Test\Modules;

use Softspring\CmsBundle\Tests\ModuleTestCase;

class TitleTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName = 'title';
        $this->modulePath = realpath(__DIR__.'/../../modules/title');
    }

    public static function provideModuleRender(): array
    {
        return [
            'custom h2 title' => [
                'data' => [
                    '_module' => 'title',
                    '_revision' => 1,
                    'id' => 'main-title',
                    'class' => 'text-center',
                    'type' => 'h2',
                    'title' => [
                        'en' => 'Main title',
                    ],
                ],
                'expected' => function (string $result): void {
                    self::assertStringContainsString('<h2', $result);
                    self::assertStringContainsString('id="main-title"', $result);
                    self::assertStringContainsString('class="sfs-title text-center"', $result);
                    self::assertStringContainsString('>Main title</h2>', $result);
                },
            ],
        ];
    }
}
