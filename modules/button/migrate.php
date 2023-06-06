<?php

use Softspring\CmsBundle\Utils\ModuleMigrator;

return static function (array $data, int $originVersion, int $targetVersion): array {
    if ($originVersion < 2 && $targetVersion >= 2) {
        /*
         * Migrate route field to symfonyRoute
         *  v1.button_link route___<route_name>
         *  v3.button_link { route_name = <route_name>, route_ }
         */
        $data['button_link'] = ModuleMigrator::routeToSymfonyRoute($data['button_link'] ?? null);
    }

    if ($originVersion < 3 && $targetVersion >= 3) {
        // Migrate button_style_custom field to button_classes
        $data['button_classes'] = $data['button_style_custom'] ?? null;
        unset($data['button_style_custom']);
    }

    if ($originVersion < 4 && $targetVersion >= 4) {
        $data['button_link'] = ModuleMigrator::symfonyRouteToLink($data['button_link'] ?? null);
    }

    return $data;
};
