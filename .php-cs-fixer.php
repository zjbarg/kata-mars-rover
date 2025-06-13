<?php

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
    ])
    ->setFinder(
        (new PhpCsFixer\Finder())
        ->in(__DIR__)
    );
