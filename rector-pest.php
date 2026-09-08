<?php

use Pest\Rector\Set\PestSetList;
use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/tests',
    ])
    ->withPhpSets()
    ->withComposerBased(laravel: true)
    ->withSets([
        PestSetList::CODING_STYLE,
    ]);
