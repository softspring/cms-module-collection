<?php

namespace Softspring\CmsModuleCollection\Test\Modules;

use Softspring\CmsBundle\Tests\ModuleTestCase;

class ButtonTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        $this->modulePath = realpath(__DIR__ . '/../../modules/button');
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
}
