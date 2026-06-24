<?php

declare(strict_types=1);

namespace Softspring\CmsModuleCollection\Test\Modules;

class TwoColumnsTest extends MediaModuleTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName = 'two_columns';
        $this->modulePath = realpath(__DIR__.'/../../modules/two_columns');
    }

    public static function provideModuleRender(): array
    {
        return [
            'two columns text content' => [
                'data' => [
                    '_module' => 'two_columns',
                    '_revision' => 5,
                    'background' => [],
                    'module_image' => [],
                    'id' => 'feature',
                    'class' => 'bg-light',
                    'bg_color' => '#eeeeee',
                    'title_class' => 'fw-semibold',
                    'title' => ['en' => 'Feature title'],
                    'title_type' => 'h2',
                    'description' => ['en' => '<p>Feature body</p>'],
                    'primary_button_text' => ['en' => 'Open'],
                    'primary_button_link' => [
                        'type' => 'url',
                        'route_name' => null,
                        'route_params' => [],
                        'url' => 'https://example.com/feature',
                        'anchor' => null,
                        'target' => '_self',
                        'custom_target' => null,
                    ],
                    'image_position_text' => 'flex-row-reverse',
                ],
                'expected' => function (string $result): void {
                    self::assertStringContainsString('id="feature"', $result);
                    self::assertStringContainsString('sfs-two-columns py-5 bg-light', $result);
                    self::assertStringContainsString('style="background-color:#eeeeee"', $result);
                    self::assertStringContainsString('<div class="row flex-row-reverse">', $result);
                    self::assertStringContainsString('<h2 class="sfs-two-columns__title fw-semibold">Feature title</h2>', $result);
                    self::assertStringContainsString('<p>Feature body</p>', $result);
                    self::assertStringContainsString('href="https://example.com/feature"', $result);
                    self::assertStringContainsString('>Open</a>', $result);
                },
                'templatesSource' => [
                    '@SfsCms/errors/module_render_error.html.twig' => '',
                ],
            ],
        ];
    }

    protected function provideDataForMigrations(): array
    {
        return [
            [
                '_revision' => 1,
                'module_image' => ['en' => 'column-media'],
                'primary_button_link' => 'route___feature',
            ],
            [
                '_revision' => 2,
                'module_image' => ['en' => ['media' => 'column-media', 'version' => 'image#sm']],
                'primary_button_link' => 'route___feature',
            ],
            [
                '_revision' => 3,
                'module_image' => ['en' => ['media' => 'column-media', 'version' => 'image#sm']],
                'primary_button_link' => [
                    'route_name' => 'feature',
                    'route_params' => [],
                ],
            ],
            [
                '_revision' => 4,
                'module_image' => ['en' => ['media' => 'column-media', 'version' => 'image#sm']],
                'primary_button_link' => [
                    'route_name' => 'feature',
                    'route_params' => [],
                ],
                'title_type' => 'h2',
            ],
            [
                '_revision' => 5,
                'module_image' => ['en' => ['media' => 'column-media', 'version' => 'image#sm']],
                'primary_button_link' => [
                    'type' => 'route',
                    'route_name' => 'feature',
                    'route_params' => [],
                    'url' => null,
                    'anchor' => null,
                    'target' => '_self',
                    'custom_target' => null,
                ],
                'title_type' => 'h2',
            ],
        ];
    }
}
