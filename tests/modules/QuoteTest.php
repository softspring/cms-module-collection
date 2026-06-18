<?php

declare(strict_types=1);

namespace Softspring\CmsModuleCollection\Test\Modules;

use Softspring\CmsBundle\Tests\ModuleTestCase;

class QuoteTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName = 'quote';
        $this->modulePath = realpath(__DIR__.'/../../modules/quote');
    }

    public static function provideModuleRender(): array
    {
        return [
            'translated quote' => [
                'data' => [
                    '_module' => 'quote',
                    '_revision' => 1,
                    'id' => 'quote',
                    'class' => 'blockquote-lg',
                    'quote' => [
                        'en' => 'A useful quote',
                    ],
                ],
                'expected' => function (string $result): void {
                    self::assertStringContainsString('<blockquote', $result);
                    self::assertStringContainsString('id="quote"', $result);
                    self::assertStringContainsString('class="sfs-quote blockquote-lg"', $result);
                    self::assertStringContainsString('>A useful quote</blockquote>', $result);
                },
            ],
        ];
    }
}
