<?php

declare(strict_types=1);

namespace Softspring\CmsModuleCollection\Test\Modules;

class TextSectionTest extends MediaModuleTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName = 'text_section';
        $this->modulePath = realpath(__DIR__.'/../../modules/text_section');
    }

    public static function provideModuleRender(): array
    {
        return [
            'text section with cta' => [
                'data' => [
                    '_module' => 'text_section',
                    '_revision' => 4,
                    'background' => [],
                    'media' => [],
                    'image' => [],
                    'id' => 'intro',
                    'class' => 'py-5',
                    'bg_color' => '#f8f9fa',
                    'title_class' => 'h2',
                    'title' => ['en' => 'Intro section'],
                    'title_type' => 'h2',
                    'description' => ['en' => '<p>Intro body</p>'],
                    'primary_button_text' => ['en' => 'Contact'],
                    'primary_button_link' => [
                        'type' => 'anchor',
                        'route_name' => null,
                        'route_params' => [],
                        'url' => null,
                        'anchor' => 'contact',
                        'target' => '_self',
                        'custom_target' => null,
                    ],
                    'primary_button_class' => 'btn-secondary',
                    'text_position' => 'text-start',
                ],
                'expected' => function (string $result): void {
                    self::assertStringContainsString('id="intro"', $result);
                    self::assertStringContainsString('sfs-text-section py-5', $result);
                    self::assertStringContainsString('style="background-color:#f8f9fa"', $result);
                    self::assertStringContainsString('sfs-text-section__content container container--no-image  text-start', $result);
                    self::assertStringContainsString('sfs-text-section__title h2', $result);
                    self::assertStringContainsString('>Intro section</h2>', $result);
                    self::assertStringContainsString('<div class="sfs-text-section__body"><p>Intro body</p></div>', $result);
                    self::assertStringContainsString('href="#contact"', $result);
                    self::assertStringContainsString('sfs-text-section__cta btn btn-primary btn-secondary', $result);
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
                'image' => ['en' => 'section-media'],
                'primary_button_link' => 'route___contact',
            ],
            [
                '_revision' => 2,
                'background' => ['en' => ['media' => 'background-media', 'version' => 'picture#_default']],
                'media' => ['en' => ['media' => 'section-media', 'version' => 'image#sm']],
                'primary_button_link' => 'route___contact',
            ],
            [
                '_revision' => 3,
                'background' => ['en' => ['media' => 'background-media', 'version' => 'picture#_default']],
                'media' => ['en' => ['media' => 'section-media', 'version' => 'image#sm']],
                'primary_button_link' => [
                    'route_name' => 'contact',
                    'route_params' => [],
                ],
            ],
            [
                '_revision' => 4,
                'background' => ['en' => ['media' => 'background-media', 'version' => 'picture#_default']],
                'media' => ['en' => ['media' => 'section-media', 'version' => 'image#sm']],
                'primary_button_link' => [
                    'type' => 'route',
                    'route_name' => 'contact',
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
