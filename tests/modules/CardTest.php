<?php

declare(strict_types=1);

namespace Softspring\CmsModuleCollection\Test\Modules;

class CardTest extends MediaModuleTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName = 'card';
        $this->modulePath = realpath(__DIR__.'/../../modules/card');
    }

    public static function provideModuleRender(): array
    {
        return [
            'card content with cta' => [
                'data' => [
                    '_module' => 'card',
                    '_revision' => 5,
                    'background' => [],
                    'media' => [],
                    'id' => 'card-1',
                    'class' => 'shadow-sm',
                    'bg_color' => '#ffffff',
                    'title_class' => 'fw-bold',
                    'title' => ['en' => 'Card title'],
                    'title_type' => 'h3',
                    'description' => ['en' => '<p>Card description</p>'],
                    'primary_button_text' => ['en' => 'Read more'],
                    'primary_button_link' => [
                        'type' => 'url',
                        'route_name' => null,
                        'route_params' => [],
                        'url' => 'https://example.com/card',
                        'anchor' => null,
                        'target' => '_blank',
                        'custom_target' => null,
                    ],
                    'primary_button_class' => 'btn-outline-primary',
                    'content_position' => 'text-center',
                ],
                'expected' => function (string $result): void {
                    self::assertStringContainsString('id="card-1"', $result);
                    self::assertStringContainsString('sfs-card h-100', $result);
                    self::assertStringContainsString('shadow-sm', $result);
                    self::assertStringContainsString('text-center', $result);
                    self::assertStringContainsString('style="background-color:#ffffff"', $result);
                    self::assertStringContainsString('sfs-card__title fw-bold', $result);
                    self::assertStringContainsString('>Card title</h3>', $result);
                    self::assertStringContainsString('<div class="sfs-card__desc mb-4"><p>Card description</p></div>', $result);
                    self::assertStringContainsString('href="https://example.com/card"', $result);
                    self::assertStringContainsString('target="_blank"', $result);
                    self::assertStringContainsString('btn btn-primary btn-outline-primary', $result);
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
                'background' => ['en' => 'background-media'],
                'other' => ['en' => 'card-media'],
                'primary_button_link' => 'route___card_show',
            ],
            [
                '_revision' => 2,
                'background' => ['en' => ['media' => 'background-media', 'version' => 'picture#_default']],
                'media' => ['en' => ['media' => 'card-media', 'version' => 'image#sm']],
                'primary_button_link' => 'route___card_show',
            ],
            [
                '_revision' => 3,
                'background' => ['en' => ['media' => 'background-media', 'version' => 'picture#_default']],
                'media' => ['en' => ['media' => 'card-media', 'version' => 'image#sm']],
                'primary_button_link' => [
                    'route_name' => 'card_show',
                    'route_params' => [],
                ],
            ],
            [
                '_revision' => 4,
                'background' => ['en' => ['media' => 'background-media', 'version' => 'picture#_default']],
                'media' => ['en' => ['media' => 'card-media', 'version' => 'image#sm']],
                'primary_button_link' => [
                    'route_name' => 'card_show',
                    'route_params' => [],
                ],
                'title_type' => 'h2',
            ],
            [
                '_revision' => 5,
                'background' => ['en' => ['media' => 'background-media', 'version' => 'picture#_default']],
                'media' => ['en' => ['media' => 'card-media', 'version' => 'image#sm']],
                'primary_button_link' => [
                    'type' => 'route',
                    'route_name' => 'card_show',
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
