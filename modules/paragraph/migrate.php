<?php

use Softspring\CmsBundle\Utils\ModuleMigrator;

return static function (array $data, int $originVersion, int $targetVersion): array {
    if (1 == $originVersion && $targetVersion >= 2) {
        list($data['class'], $data['spacing']) = ModuleMigrator::classToSpacing($data['class']);
    }

    return $data;
};
