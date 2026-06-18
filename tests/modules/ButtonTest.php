<?php

declare(strict_types=1);

namespace Softspring\CmsModuleCollection\Test\Modules;

use Softspring\CmsBundle\Tests\ModuleTestCase;
use Softspring\TranslatableBundle\Model\Translation;

class ButtonTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName = 'button';
        $this->modulePath = realpath(__DIR__.'/../../modules/button');
    }

    public static function provideModuleRender(): array
    {
        return [
            'url button with custom id, classes and target' => [
                'data' => [
                    '_module' => 'button',
                    '_revision' => 4,
                    'id' => 'download',
                    'button_style' => 'btn btn-primary',
                    'button_classes' => 'bg-white',
                    'button_text' => [
                        'en' => 'Download',
                    ],
                    'button_link' => [
                        'type' => 'url',
                        'route_name' => null,
                        'route_params' => [],
                        'url' => 'https://example.com/download',
                        'anchor' => null,
                        'target' => '_blank',
                        'custom_target' => null,
                    ],
                ],
                'expected' => function (string $result): void {
                    self::assertStringContainsString('id="download"', $result);
                    self::assertStringContainsString('class="bg-white btn btn-primary"', $result);
                    self::assertStringContainsString('href="https://example.com/download"', $result);
                    self::assertStringContainsString('target="_blank"', $result);
                    self::assertStringContainsString('>Download</a>', $result);
                },
            ],
            'anchor button' => [
                'data' => [
                    '_module' => 'button',
                    '_revision' => 4,
                    'id' => null,
                    'button_style' => 'btn btn-link',
                    'button_classes' => null,
                    'button_text' => [
                        'en' => 'Jump',
                    ],
                    'button_link' => [
                        'type' => 'anchor',
                        'route_name' => null,
                        'route_params' => [],
                        'url' => null,
                        'anchor' => 'details',
                        'target' => '_self',
                        'custom_target' => null,
                    ],
                ],
                'expected' => function (string $result): void {
                    self::assertStringContainsString('class="btn btn-link"', $result);
                    self::assertStringContainsString('href="#details"', $result);
                    self::assertStringNotContainsString('target=', $result);
                    self::assertStringContainsString('>Jump</a>', $result);
                },
            ],
            'empty text does not render a link' => [
                'data' => [
                    '_module' => 'button',
                    '_revision' => 4,
                    'id' => 'empty',
                    'button_style' => 'btn btn-primary',
                    'button_classes' => null,
                    'button_text' => [
                        'en' => '',
                    ],
                    'button_link' => [
                        'type' => 'url',
                        'route_name' => null,
                        'route_params' => [],
                        'url' => 'https://example.com',
                        'anchor' => null,
                        'target' => '_self',
                        'custom_target' => null,
                    ],
                ],
                'expected' => '',
            ],
        ];
    }

    protected function provideDataForMigrations(): array
    {
        return [
            [
                '_revision' => 1,
                'id' => null,
                'button_style' => 'btn btn-primary',
                'button_style_custom' => 'bg-white',
                'button_text' => ['en' => 'Test button'],
                'button_link' => 'route___home',
            ],
            [
                '_revision' => 2,
                'id' => null,
                'button_style' => 'btn btn-primary',
                'button_style_custom' => 'bg-white',
                'button_text' => ['en' => 'Test button'],
                'button_link' => [
                    'route_name' => 'home',
                    'route_params' => [],
                ],
            ],
            [
                '_revision' => 3,
                'id' => null,
                'button_style' => 'btn btn-primary',
                'button_classes' => 'bg-white',
                'button_text' => ['en' => 'Test button'],
                'button_link' => [
                    'route_name' => 'home',
                    'route_params' => [],
                ],
            ],
            [
                '_revision' => 4,
                'id' => null,
                'button_style' => 'btn btn-primary',
                'button_classes' => 'bg-white',
                'button_text' => ['en' => 'Test button'],
                'button_link' => [
                    'type' => 'route',
                    'route_name' => 'home',
                    'route_params' => [],
                    'url' => null,
                    'anchor' => null,
                    'target' => '_self',
                    'custom_target' => null,
                ],
            ],
        ];
    }

    public function testEmptyForm(): void
    {
        $config = $this->readModuleConfiguration();
        $form = $this->getModuleForm($config);
        $form->submit([]);
        $form->getData();

        $this->assertTrue($form->isSynchronized());
    }

    public function testForm(): void
    {
        $config = $this->readModuleConfiguration();
        $form = $this->getModuleForm($config);
        $form->submit([
            'locale_filter' => ['es'],
            'id' => '',
            'button_style' => 'btn btn-primary',
            'button_classes' => '',
            'button_text' => [
                'es' => 'Prueba',
                'en' => 'Test',
            ],
            'button_link' => [
                'type' => 'url',
                'route_name' => '',
                'route_params' => '',
                'anchor' => '',
                'url' => 'https://github.com/softspring/cms-bundle',
                'target' => '_self',
                'custom_target' => '',
            ],
        ]);
        $processedData = $form->getData();

        $this->assertTrue($form->isSynchronized());

        /** @var Translation $buttonTextTranslations */
        $buttonTextTranslations = $processedData['button_text'];
        unset($processedData['button_text']);

        $this->assertEquals([
            '_node_discr' => null,
            '_revision' => null,
            'id' => null,
            'button_classes' => null,
            'button_style' => 'btn btn-primary',
            'button_link' => [
                'type' => 'url',
                'route_name' => '',
                'route_params' => '',
                'anchor' => '',
                'url' => 'https://github.com/softspring/cms-bundle',
                'target' => '_self',
                'custom_target' => '',
            ],
        ], $processedData);

        $this->assertEquals([
            'es' => 'Prueba',
            'en' => 'Test',
            '_trans_id' => null,
        ], $buttonTextTranslations->getTranslations());
    }
}
