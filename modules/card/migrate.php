<?php
return static function (array $data, int $originVersion, int $targetVersion): array {
    if ($originVersion == 1 && $targetVersion >= 2) {
        /**
         * Migrate v1 translatableImage field to translatable.mediaVersion
         *  v1.background { locale => Media }
         *  v2.background { locale = { media => Media, version => string } }
         */
        if (!empty($data['background'])) {
            $background = $data['background'];
            unset($data['background']);
            foreach ($background as $locale => $media) {
                $data['background'][$locale] = [ 'media' => $media, 'version' => 'picture#_default' ];
            }
        }

        /**
         * Migrate v1 translatableImage field to translatable.mediaVersion
         *  v1.other { locale => Media }
         *  v2.media { locale = { media => Media, version => string } }
         */
        if (!empty($data['other'])) {
            foreach ($data['other'] as $locale => $media) {
                $data['media'][$locale] = [ 'media' => $media, 'version' => 'image#sm' ];
            }
            unset($data['other']);
        }
    }

    return $data;
};
