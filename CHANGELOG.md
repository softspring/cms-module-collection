# CHANGELOG

## [v5.0.6](https://github.com/softspring/cms-module-collection/releases/tag/v5.0.6)

### Upgrading

*Nothing to do on upgrading*

### Commits

- [f613f26](https://github.com/softspring/cms-module-collection/commit/f613f26b0b43e311dfb1110d30dc240bd68b46b8): Migrate button module to 3rd revision
- [2ef512a](https://github.com/softspring/cms-module-collection/commit/2ef512adb07a7d0dddff291f950626b9cc519b8e): BUNDLES-165 Set default value in render
- [5dadf77](https://github.com/softspring/cms-module-collection/commit/5dadf77696400af6526ede2444882b1c3dc62acb): BUNDLES-165 Remove default values
- [7afaf29](https://github.com/softspring/cms-module-collection/commit/7afaf29f74ff6af355ca34407ef1d94ea22d1015): BUNDLE-165 Add none button styles
- [03d0854](https://github.com/softspring/cms-module-collection/commit/03d0854a0b62133ee580dc452965ee2d0dc281d6): BUNDLES-165 fixed button classes preview and render

### Changes

```
 modules/button/config.yaml                          | 5 +++--
 modules/button/edit.html.twig                       | 2 +-
 modules/button/form.html.twig                       | 2 +-
 modules/button/migrate.php                          | 6 ++++++
 modules/button/render.html.twig                     | 2 +-
 modules/button/translations/sfs_cms_modules.en.yaml | 4 ++--
 modules/button/translations/sfs_cms_modules.es.yaml | 4 ++--
 7 files changed, 16 insertions(+), 9 deletions(-)
```

## [v5.0.5](https://github.com/softspring/cms-module-collection/releases/tag/v5.0.5)

### Upgrading

*Nothing to do on upgrading*

### Commits

- [a6d5f71](https://github.com/softspring/cms-module-collection/commit/a6d5f714a96a8d5b260617b3d89c23fc337653bb): Update changelog
- [05f12b8](https://github.com/softspring/cms-module-collection/commit/05f12b8935a5fa54c7973f3b94df9ecb27dd4c31): Fix image preview size in Two columns module

### Changes

```
 CHANGELOG.md                       | 82 ++++++++++++++++++++++++++++++++++++++
 modules/two_columns/edit.html.twig |  2 +-
 2 files changed, 83 insertions(+), 1 deletion(-)
```

## [v5.0.4](https://github.com/softspring/cms-module-collection/releases/tag/v5.0.4)

### Upgrading

*Nothing to do on upgrading*

### Commits

- [8afaed0](https://github.com/softspring/cms-module-collection/commit/8afaed00b2bf7ac9dde17b9c8c15f49e3b379819): BUNDLES-160 - fix missing translations

### Changes

```
 modules/button/form.html.twig                             | 2 +-
 modules/button/translations/sfs_cms_modules.en.yaml       | 4 +++-
 modules/button/translations/sfs_cms_modules.es.yaml       | 4 +++-
 modules/card/form.html.twig                               | 2 +-
 modules/card/translations/sfs_cms_modules.en.yaml         | 5 +++--
 modules/card/translations/sfs_cms_modules.es.yaml         | 6 +++---
 modules/hero/form.html.twig                               | 4 ++--
 modules/hero/translations/sfs_cms_modules.en.yaml         | 8 ++++++--
 modules/hero/translations/sfs_cms_modules.es.yaml         | 8 ++++++--
 modules/text_section/form.html.twig                       | 2 +-
 modules/text_section/translations/sfs_cms_modules.en.yaml | 4 +++-
 modules/text_section/translations/sfs_cms_modules.es.yaml | 6 ++++--
 modules/two_columns/form.html.twig                        | 2 +-
 modules/two_columns/translations/sfs_cms_modules.en.yaml  | 4 +++-
 modules/two_columns/translations/sfs_cms_modules.es.yaml  | 4 +++-
 15 files changed, 43 insertions(+), 22 deletions(-)
```

## [v5.0.3](https://github.com/softspring/cms-module-collection/releases/tag/v5.0.3)

*Nothing has changed since last v5.0.2 version*

## [v5.0.2](https://github.com/softspring/cms-module-collection/releases/tag/v5.0.2)

### Upgrading

*Nothing to do on upgrading*

### Commits

- [b1a6632](https://github.com/softspring/cms-module-collection/commit/b1a6632d35e58ec5bdef385cc7675341ebeb52f2): BUNDLES-152 - require cms-bundle ^5.0.2
- [73df263](https://github.com/softspring/cms-module-collection/commit/73df263dd3747bbccef8e538a3a030892b2534ab): BUNDLES-152 - check php code style
- [c7fe245](https://github.com/softspring/cms-module-collection/commit/c7fe2451920dde9201e6a5a42071443ea8575cfb): BUNDLES-152 - migrate modules to symfonyRoute type

### Changes

```
 .github/workflows/php.yml             | 58 +++++++++++++++++++----------------
 .gitignore                            |  3 +-
 .php-cs-fixer.php                     | 15 +++++++++
 composer.json                         |  6 +++-
 modules/button/config.yaml            |  4 +--
 modules/button/migrate.php            | 16 ++++++++++
 modules/button/render.html.twig       |  2 +-
 modules/card/config.yaml              |  4 +--
 modules/card/migrate.php              | 22 ++++++++++---
 modules/card/render.html.twig         |  2 +-
 modules/hero/config.yaml              |  6 ++--
 modules/hero/migrate.php              | 28 ++++++++++++++---
 modules/hero/render.html.twig         |  4 +--
 modules/text_section/config.yaml      |  4 +--
 modules/text_section/migrate.php      | 22 ++++++++++---
 modules/text_section/render.html.twig |  2 +-
 modules/two_columns/config.yaml       |  4 +--
 modules/two_columns/migrate.php       | 18 +++++++++--
 modules/two_columns/render.html.twig  |  2 +-
 phpstan.neon.dist                     |  6 ++++
 20 files changed, 165 insertions(+), 63 deletions(-)
```

## [v5.0.1](https://github.com/softspring/cms-module-collection/releases/tag/v5.0.1)

*Nothing has changed since last v5.0.0 version*

## [v5.0.0](https://github.com/softspring/cms-module-collection/releases/tag/v5.0.0)

*Previous versions are not in changelog*
