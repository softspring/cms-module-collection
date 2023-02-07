<?php

$finder = PhpCsFixer\Finder::create()
    ->in('modules')
    ->exclude('vendor')
;

$config = new PhpCsFixer\Config();
    return $config->setRules([
        '@Symfony' => true,
        'full_opening_tag' => false,
        'phpdoc_separation' => false,
    ])
    ->setFinder($finder)
;