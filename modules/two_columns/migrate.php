<?php
return static function (array $data, int $originVersion, int $targetVersion): array {
    if ($originVersion == 1 && $targetVersion >= 2) {
        /**
         * Migrate v1 translatableImage field to translatable.mediaVersion
         *  v1.module_image { locale => Media }
         *  v2.module_image { locale = { media => Media, version => string } }
         */
        if (!empty($data['module_image'])) {
            $module_image = $data['module_image'];
            unset($data['module_image']);
            foreach ($module_image as $locale => $media) {
                $data['module_image'][$locale] = [ 'media' => $media, 'version' => 'image#sm' ];
            }
        }
    }

    return $data;
};
