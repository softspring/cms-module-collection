<?php

declare(strict_types=1);

namespace Softspring\CmsModuleCollection\Test\Modules;

class HeroTest extends MediaModuleTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName = 'hero';
        $this->modulePath = realpath(__DIR__.'/../../modules/hero');
    }

    public static function provideModuleRender(): array
    {
        return [
            'hero with two buttons' => [
                'data' => [
                    '_module' => 'hero',
                    '_revision' => 4,
                    'background' => [],
                    'media' => [],
                    'id' => 'home-hero',
                    'class' => 'text-white',
                    'fullpage' => 'hero--fullpage',
                    'bg_color' => '#000000',
                    'title_class' => 'display-1',
                    'title' => ['en' => 'Hero title'],
                    'title_type' => 'h1',
                    'description' => ['en' => '<p>Hero description</p>'],
                    'primary_button_text' => ['en' => 'Start'],
                    'primary_button_link' => [
                        'type' => 'route',
                        'route_name' => 'start',
                        'route_params' => [],
                        'url' => null,
                        'anchor' => null,
                        'target' => '_self',
                        'custom_target' => null,
                    ],
                    'secondary_button_text' => ['en' => 'Docs'],
                    'secondary_button_link' => [
                        'type' => 'url',
                        'route_name' => null,
                        'route_params' => [],
                        'url' => 'https://example.com/docs',
                        'anchor' => null,
                        'target' => '_blank',
                        'custom_target' => null,
                    ],
                ],
                'expected' => function (string $result): void {
                    self::assertStringContainsString('id="home-hero"', $result);
                    self::assertStringContainsString('sfs-hero hero--fullpage text-white', $result);
                    self::assertStringContainsString('style="background-color:#000000"', $result);
                    self::assertStringContainsString('sfs-hero__title display-1', $result);
                    self::assertStringContainsString('>Hero title</h1>', $result);
                    self::assertStringContainsString('<div class="lead mb-4"><p>Hero description</p></div>', $result);
                    self::assertStringContainsString('href="/start"', $result);
                    self::assertStringContainsString('>Start</a>', $result);
                    self::assertStringContainsString('href="https://example.com/docs"', $result);
                    self::assertStringContainsString('target="_blank"', $result);
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
                'other' => ['en' => 'hero-media'],
                'primary_button_link' => 'route___start',
                'secondary_button_link' => 'route___docs',
            ],
            [
                '_revision' => 2,
                'background' => ['en' => ['media' => 'background-media', 'version' => 'picture#_default']],
                'media' => ['en' => ['media' => 'hero-media', 'version' => 'image#sm']],
                'primary_button_link' => 'route___start',
                'secondary_button_link' => 'route___docs',
            ],
            [
                '_revision' => 3,
                'background' => ['en' => ['media' => 'background-media', 'version' => 'picture#_default']],
                'media' => ['en' => ['media' => 'hero-media', 'version' => 'image#sm']],
                'primary_button_link' => [
                    'route_name' => 'start',
                    'route_params' => [],
                ],
                'secondary_button_link' => [
                    'route_name' => 'docs',
                    'route_params' => [],
                ],
            ],
            [
                '_revision' => 4,
                'background' => ['en' => ['media' => 'background-media', 'version' => 'picture#_default']],
                'media' => ['en' => ['media' => 'hero-media', 'version' => 'image#sm']],
                'primary_button_link' => [
                    'type' => 'route',
                    'route_name' => 'start',
                    'route_params' => [],
                    'url' => null,
                    'anchor' => null,
                    'target' => '_self',
                    'custom_target' => null,
                ],
                'secondary_button_link' => [
                    'type' => 'route',
                    'route_name' => 'docs',
                    'route_params' => [],
                    'url' => null,
                    'anchor' => null,
                    'target' => '_self',
                    'custom_target' => null,
                ],
            ],
        ];
    }
}
