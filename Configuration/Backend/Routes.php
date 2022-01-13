<?php

/**
 * Override route "/record/commit" definition provided by EXT:backend
 */
return [
    /**
     * TCE gateway (TYPO3 Core Engine) for database handling
     * This script is a gateway for POST forms to \TYPO3\CMS\Core\DataHandling\DataHandler
     * that manipulates all information in the database!!
     * For syntax and API information, see the document 'TYPO3 Core APIs'
     */
    'tce_db' => [
        'path' => '/record/commit',
        'target' => Fr\LocalizationHandling\Controller\SimpleDataHandlerController::class . '::mainAction'
    ],
];
