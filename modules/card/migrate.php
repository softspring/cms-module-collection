<?php

use Softspring\CmsBundle\Utils\DataMigrator;

return static function (array $data, int $originVersion, int $targetVersion): array {
    if (1 == $originVersion && $targetVersion >= 2) {
        /*
         * Migrate v1 translatableImage field to translatable.mediaVersion
         *  v1.background { locale => Media }
         *  v2.background { locale = { media => Media, version => string } }
         */
        if (!empty($data['background'])) {
            $background = $data['background'];
            unset($data['background']);
            foreach ($background as $locale => $media) {
                $data['background'][$locale] = ['media' => $media, 'version' => 'picture#_default'];
            }
        }

        /*
         * Migrate v1 translatableImage field to translatable.mediaVersion
         *  v1.other { locale => Media }
         *  v2.media { locale = { media => Media, version => string } }
         */
        if (!empty($data['other'])) {
            foreach ($data['other'] as $locale => $media) {
                $data['media'][$locale] = ['media' => $media, 'version' => 'image#sm'];
            }
            unset($data['other']);
        }
    }

    if ($originVersion < 3 && $targetVersion >= 3) {
        /*
         * Migrate route field to symfonyRoute
         *  v1.primary_button_link route___<route_name>
         *  v3.primary_button_link { route_name = <route_name>, route_ }
         */
        $data['primary_button_link'] = DataMigrator::routeToSymfonyRoute($data['primary_button_link'] ?? null);
    }

    if ($originVersion < 4 && $targetVersion >= 4) {
        $data['title_type'] = $data['title_type'] ?? 'h2';
    }

    if ($originVersion < 5 && $targetVersion >= 5) {
        $data['primary_button_link'] = DataMigrator::symfonyRouteToLink($data['primary_button_link'] ?? null);
    }

    return $data;
};
