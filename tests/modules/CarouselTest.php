<?php

declare(strict_types=1);

namespace Softspring\CmsModuleCollection\Test\Modules;

use Softspring\CmsBundle\Tests\ModuleTestCase;

class CarouselTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName = 'carousel';
        $this->modulePath = realpath(__DIR__.'/../../modules/carousel');
    }

    public static function provideModuleRender(): array
    {
        return [
            'carousel renders configured empty container' => [
                'data' => [
                    '_module' => 'carousel',
                    '_revision' => 1,
                    'id' => 'featured-carousel',
                    'class' => 'mb-4',
                    'bg_color' => '#f1f3f5',
                    'items_per_slide' => 'auto',
                    'infinite_loop' => 0,
                    'auto_play' => 1,
                    'navigation' => 0,
                    'pagination' => 1,
                    'modules' => [],
                ],
                'expected' => function (string $result): void {
                    self::assertStringContainsString('id="featured-carousel"', $result);
                    self::assertStringContainsString('sfs-carousel swiper-module mb-4', $result);
                    self::assertStringContainsString('style="background-color:#f1f3f5"', $result);
                    self::assertStringContainsString('data-slides-per-view="auto"', $result);
                    self::assertStringContainsString('data-infinite-loop="0"', $result);
                    self::assertStringContainsString('data-autoplay="1"', $result);
                    self::assertStringContainsString('swiper-pagination', $result);
                    self::assertStringNotContainsString('swiper-button-prev', $result);
                    self::assertStringNotContainsString('swiper-slide', $result);
                },
                'templatesSource' => [
                    '@SfsCms/errors/module_render_error.html.twig' => '',
                ],
            ],
        ];
    }
}
