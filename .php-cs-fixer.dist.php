<?php

$finder = (new PhpCsFixer\Finder())
    ->in(dirs: [__DIR__ . '/src', __DIR__ . '/tests', ])
;

return (new PhpCsFixer\Config())
    ->setRules(rules: [
        '@Symfony' => true,
        '@PHP84Migration' => true,
    ])
    ->setCacheFile(cacheFile: '/var/tmp/cache/.php-cs-fixer.cache')
    ->setFinder(finder: $finder)
;
