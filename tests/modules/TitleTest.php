<?php

namespace Softspring\CmsModuleCollection\Test\Modules;

use Softspring\CmsBundle\Tests\ModuleTestCase;

class TitleTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName = 'title';
        $this->modulePath = realpath(__DIR__ . '/../../modules/title');
    }

    protected function provideDataForMigrations(): array
    {
        return [
            [
                '_revision' => 1,
                'id' => 'mainTitle',
                'class' => 'example mx-2 my-3 text-dark pt-1 pb-2 ps-3 other-class',
                'type' => 'h1',
                'title' => ['en' => 'Test title'],
            ],
            [
                '_revision' => 2,
                'id' => 'mainTitle',
                'class' => 'example text-dark other-class',
                'type' => 'h1',
                'title' => ['en' => 'Test title'],
                'spacing' => [
                    'marginTop' => 'mt-3',
                    'marginEnd' => 'me-2',
                    'marginBottom' => 'mb-3',
                    'marginStart' => 'ms-2',
                    'paddingTop' => 'pt-1',
                    'paddingEnd' => 'pe-0',
                    'paddingBottom' => 'pb-2',
                    'paddingStart' => 'ps-3',
                ],
            ],
        ];
    }
//
//    public function testEmptyForm(): void
//    {
//        $config = $this->readModuleConfiguration();
//        $form = $this->getModuleForm($config);
//        $form->submit([]);
//        $procesedData = $form->getData();
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
//            'title_style' => 'btn btn-primary',
//            'title_classes' => '',
//            'title_text' => [
//                'es' => 'Prueba',
//                'en' => 'Test',
//            ],
//            'title_link' => [
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
//        $this->assertEquals([
//            '_node_discr' => null,
//            '_revision' => null,
//            'id' => null,
//            'title_style' => 'btn btn-primary',
//            'title_classes' => null,
//            'title_text' => [
//                'es' => 'Prueba',
//                'en' => 'Test',
//            ],
//            'title_link' => [
//                'type' => 'url',
//                'route_name' => '',
//                'route_params' => '',
//                'anchor' => '',
//                'url' => 'https://github.com/softspring/cms-bundle',
//                'target' => '_self',
//                'custom_target' => '',
//            ],
//        ], $procesedData);
//    }
}
