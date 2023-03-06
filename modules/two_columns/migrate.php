<?php

use Softspring\CmsBundle\Utils\ModuleMigrator;

return static function (array $data, int $originVersion, int $targetVersion): array {
    if (1 == $originVersion && $targetVersion >= 2) {
        /*
         * Migrate v1 translatableImage field to translatable.mediaVersion
         *  v1.module_image { locale => Media }
         *  v2.module_image { locale = { media => Media, version => string } }
         */
        if (!empty($data['module_image'])) {
            $module_image = $data['module_image'];
            unset($data['module_image']);
            foreach ($module_image as $locale => $media) {
                $data['module_image'][$locale] = ['media' => $media, 'version' => 'image#sm'];
            }
        }
    }

    if ($originVersion < 3 && $targetVersion >= 3) {
        /*
         * Migrate route field to symfonyRoute
         *  v1.primary_button_link route___<route_name>
         *  v3.primary_button_link { route_name = <route_name>, route_ }
         */
        $data['primary_button_link'] = ModuleMigrator::routeToSymfonyRoute($data['primary_button_link'] ?? null);
    }

    if ($originVersion < 4 && $targetVersion >= 4) {
        $data['title_type'] = $data['title_type'] ?? 'h2';
    }

    return $data;
};
