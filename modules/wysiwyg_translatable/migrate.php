<?php

return static function (array $data, int $originVersion, int $targetVersion): array {
    if (1 == $originVersion && $targetVersion >= 2) {
        $data['html_content'] = $data['content'];
        unset($data['content']);
    }

    return $data;
};
