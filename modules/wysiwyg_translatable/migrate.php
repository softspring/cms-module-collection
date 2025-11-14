<?php

return static function (array $data, int $originVersion, int $targetVersion): array {
    if (1 == $originVersion && $targetVersion >= 2) {
        /*
         * Migrate v1 content to text field
         */
        if (!empty($data['content'])) {
            $data['code'] = $data['content'];
            unset($data['content']);
        }
    }

    return $data;
};
