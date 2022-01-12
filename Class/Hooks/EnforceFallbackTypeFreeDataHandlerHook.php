<?php
declare(strict_types=1);

/*
 * This file is part of the fr_localization_handling project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

namespace Fr\LocalizationHandling\Hooks;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;


/**
 * Class DataHandlerHook
 */
class EnforceFallbackTypeFreeDataHandlerHook
{

    public function processDatamap_afterAllOperations(DataHandler $dataHandler) {
        $stop = 1;
    }

    /**
     * @param string $table
     * @param int $id
     * @return array
     */
    protected function getRecord(string $table, int $id): array
    {
        return BackendUtility::getRecord($table, $id);
    }
}
