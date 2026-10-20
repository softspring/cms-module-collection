<?php

declare(strict_types=1);

return static function (array $data, int $originVersion, int $targetVersion): array {
    if (1 === $originVersion && $targetVersion >= 2 && array_key_exists('content', $data)) {
        if (!array_key_exists('html_content', $data)) {
            $data['html_content'] = $data['content'];
        }
        unset($data['content']);
    }

    // Version 5.6 stored revision 2 in code; 6.0 already used html_content.
    if ($originVersion < 3 && $targetVersion >= 3 && array_key_exists('code', $data)) {
        if (!array_key_exists('html_content', $data)) {
            $data['html_content'] = $data['code'];
        }
        unset($data['code']);
    }

    return $data;
};
