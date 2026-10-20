<?php

declare(strict_types=1);

namespace Softspring\CmsModuleCollection\Test\Modules;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class WysiwygVersionMigrationTest extends TestCase
{
    public static function provideVersionData(): iterable
    {
        foreach (['wysiwyg', 'wysiwyg_translatable'] as $module) {
            yield "$module legacy content" => [$module, 1, ['content' => '<p>Legacy</p>'], '<p>Legacy</p>'];
            yield "$module published 5.6 code" => [$module, 2, ['code' => '<p>Published</p>'], '<p>Published</p>'];
            yield "$module existing 6.0 content" => [$module, 2, ['html_content' => '<p>Current</p>'], '<p>Current</p>'];
            yield "$module empty content" => [$module, 2, ['code' => ''], ''];
            yield "$module null content" => [$module, 1, ['content' => null], null];
            yield "$module existing content wins" => [$module, 2, ['html_content' => 'current', 'code' => 'old'], 'current'];
            yield "$module translations" => [$module, 2, ['code' => ['es' => 'Hola', 'en' => 'Hello', '_trans_id' => 'translation-id']], ['es' => 'Hola', 'en' => 'Hello', '_trans_id' => 'translation-id']];
        }
    }

    #[DataProvider('provideVersionData')]
    public function testPreservesContentAcrossVersionBranches(string $module, int $originVersion, array $data, mixed $expected): void
    {
        $migrate = require __DIR__.'/../../modules/'.$module.'/migrate.php';
        $data['id'] = 'module-id';
        $result = $migrate($data, $originVersion, 3);

        self::assertSame($expected, $result['html_content']);
        self::assertSame('module-id', $result['id']);
        self::assertArrayNotHasKey('content', $result);
        self::assertArrayNotHasKey('code', $result);
        self::assertSame($result, $migrate($result, 3, 3));
    }
}
