<?php

namespace Softspring\CmsModuleCollection\Test\Modules;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Softspring\CmsBundle\Tests\ModuleTestCase;
use Softspring\TranslatableBundle\Model\Translation;

class ButtonTest extends TestCase
//class ButtonTest extends ModuleTestCase
{
//    protected function setUp(): void
//    {
//        parent::setUp();
//        $this->moduleName = 'button';
//        $this->modulePath = realpath(__DIR__.'/../../modules/button');
//    }
//
//    /**
//     * @throws Exception
//     */
//    public function testRender(array $data, string|callable $expected, array $templatesSource = []): void
//    {
//        $this->markTestSkipped();
//    }
//
//    public function testModuleForm(): void
//    {
//        $this->markTestSkipped();
//    }
//
//    public static function provideModuleRender(): array
//    {
//        return [
//            // [[], '', []],
////            [
////                'data' => [
////                    '_module' => 'button',
////                    '_revision' => 4,
////                    'id' => 'test',
////                    'button_classes' => 'bg-white',
////                    'button_style' => 'btn btn-primary',
////                    'button_text' => [
////                        'en' => 'Test button',
////                    ],
////                    'button_link' => [
////                        'type' => 'url',
////                        'route_name' => null,
////                        'route_params' => [],
////                        'url' => 'https://example.com',
////                        'anchor' => null,
////                        'target' => '_blank',
////                        'custom_target' => null,
////                    ],
////                ],
////                'expected' => function($result) {
////                    ModuleTestCase::assertRenderText('body { background-color: red; }', $result, null, '//style');
////                },
////            ]
//        ];
//    }
//
//    protected function provideDataForMigrations(): array
//    {
//        return [
//            [
//                '_revision' => 1,
//                'id' => null,
//                'button_style' => 'btn btn-primary',
//                'button_style_custom' => 'bg-white',
//                'button_text' => ['en' => 'Test button'],
//                'button_link' => 'route___home',
//            ],
//            [
//                '_revision' => 2,
//                'id' => null,
//                'button_style' => 'btn btn-primary',
//                'button_style_custom' => 'bg-white',
//                'button_text' => ['en' => 'Test button'],
//                'button_link' => [
//                    'route_name' => 'home',
//                    'route_params' => [],
//                ],
//            ],
//            [
//                '_revision' => 3,
//                'id' => null,
//                'button_style' => 'btn btn-primary',
//                'button_classes' => 'bg-white',
//                'button_text' => ['en' => 'Test button'],
//                'button_link' => [
//                    'route_name' => 'home',
//                    'route_params' => [],
//                ],
//            ],
//            [
//                '_revision' => 4,
//                'id' => null,
//                'button_style' => 'btn btn-primary',
//                'button_classes' => 'bg-white',
//                'button_text' => ['en' => 'Test button'],
//                'button_link' => [
//                    'type' => 'route',
//                    'route_name' => 'home',
//                    'route_params' => [],
//                    'url' => null,
//                    'anchor' => null,
//                    'target' => '_self',
//                    'custom_target' => null,
//                ],
//            ],
//        ];
//    }
//
//    public function testEmptyForm(): void
//    {
//        $config = $this->readModuleConfiguration();
//        $form = $this->getModuleForm($config);
//        $form->submit([]);
//        $form->getData();
//
//        $this->assertTrue($form->isSynchronized());
//        // $this->assertFalse($form->isValid());
//    }
//
//    public function testForm(): void
//    {
//        $config = $this->readModuleConfiguration();
//        $form = $this->getModuleForm($config);
//        $form->submit([
//            'locale_filter' => ['es'],
//            'id' => '',
//            'button_style' => 'btn btn-primary',
//            'button_classes' => '',
//            'button_text' => [
//                'es' => 'Prueba',
//                'en' => 'Test',
//            ],
//            'button_link' => [
//                'type' => 'url',
//                'route_name' => '',
//                'route_params' => '',
//                'anchor' => '',
//                'url' => 'https://github.com/softspring/cms-bundle',
//                'target' => '_self',
//                'custom_target' => '',
//            ],
//        ]);
//        $procesedData = $form->getData();
//
//        $this->assertTrue($form->isSynchronized());
//
//        /** @var Translation $buttonTextTranslations */
//        $buttonTextTranslations = $procesedData['button_text'];
//        unset($procesedData['button_text']);
//
//        $this->assertEquals([
//            '_node_discr' => null,
//            '_revision' => null,
//            'id' => null,
//            'button_style' => 'btn btn-primary',
//            'button_classes' => null,
//            // button_text is a translatable field
//            'button_link' => [
//                'type' => 'url',
//                'route_name' => '',
//                'route_params' => '',
//                'anchor' => '',
//                'url' => 'https://github.com/softspring/cms-bundle',
//                'target' => '_self',
//                'custom_target' => '',
//            ],
//        ], $procesedData);
//
//        $this->assertEquals([
//            'es' => 'Prueba',
//            'en' => 'Test',
//            '_trans_id' => null,
//        ], $buttonTextTranslations->getTranslations());
//    }
}
