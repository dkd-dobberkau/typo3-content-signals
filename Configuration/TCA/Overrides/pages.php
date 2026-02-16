<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

$signalFields = [
    'tx_dkdcontentsignals_ai_train' => [
        'exclude' => true,
        'label' => 'LLL:EXT:dkd_content_signals/Resources/Private/Language/locallang.xlf:pages.tx_dkdcontentsignals_ai_train',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['label' => 'LLL:EXT:dkd_content_signals/Resources/Private/Language/locallang.xlf:signal.default', 'value' => ''],
                ['label' => 'LLL:EXT:dkd_content_signals/Resources/Private/Language/locallang.xlf:signal.yes', 'value' => 'yes'],
                ['label' => 'LLL:EXT:dkd_content_signals/Resources/Private/Language/locallang.xlf:signal.no', 'value' => 'no'],
            ],
            'default' => '',
        ],
    ],
    'tx_dkdcontentsignals_search' => [
        'exclude' => true,
        'label' => 'LLL:EXT:dkd_content_signals/Resources/Private/Language/locallang.xlf:pages.tx_dkdcontentsignals_search',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['label' => 'LLL:EXT:dkd_content_signals/Resources/Private/Language/locallang.xlf:signal.default', 'value' => ''],
                ['label' => 'LLL:EXT:dkd_content_signals/Resources/Private/Language/locallang.xlf:signal.yes', 'value' => 'yes'],
                ['label' => 'LLL:EXT:dkd_content_signals/Resources/Private/Language/locallang.xlf:signal.no', 'value' => 'no'],
            ],
            'default' => '',
        ],
    ],
    'tx_dkdcontentsignals_ai_input' => [
        'exclude' => true,
        'label' => 'LLL:EXT:dkd_content_signals/Resources/Private/Language/locallang.xlf:pages.tx_dkdcontentsignals_ai_input',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['label' => 'LLL:EXT:dkd_content_signals/Resources/Private/Language/locallang.xlf:signal.default', 'value' => ''],
                ['label' => 'LLL:EXT:dkd_content_signals/Resources/Private/Language/locallang.xlf:signal.yes', 'value' => 'yes'],
                ['label' => 'LLL:EXT:dkd_content_signals/Resources/Private/Language/locallang.xlf:signal.no', 'value' => 'no'],
            ],
            'default' => '',
        ],
    ],
];

ExtensionManagementUtility::addTCAcolumns('pages', $signalFields);

ExtensionManagementUtility::addFieldsToPalette(
    'pages',
    'tx_dkdcontentsignals',
    'tx_dkdcontentsignals_ai_train, tx_dkdcontentsignals_search, tx_dkdcontentsignals_ai_input'
);

ExtensionManagementUtility::addToAllTCAtypes(
    'pages',
    '--palette--;LLL:EXT:dkd_content_signals/Resources/Private/Language/locallang.xlf:palette.dkd_content_signals;tx_dkdcontentsignals',
    '',
    'after:abstract'
);
