<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Content Signals',
    'description' => 'Adds Content-Signal meta tags to pages per contentsignals.org spec. Configurable globally via TypoScript constants and per page via TCA fields.',
    'category' => 'fe',
    'author' => 'dkd Internet Service GmbH',
    'author_email' => 'info@dkd.de',
    'state' => 'stable',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-13.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
