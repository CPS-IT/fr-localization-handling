<?php
/*
 * This file is part of the fr_localization_handling project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 */

declare(strict_types=1);

namespace Fr\LocalizationHandling\Hooks;

use Fr\LocalizationHandling\Service\FreeModeLocalizationEnforcer;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class DataHandlerFreeModeLocalizationEnforcerHook
{
    private const TABLE_TT_CONTENT = 'tt_content';

    public function processCmdmap_beforeStart(DataHandler $dataHandler): void
    {
        if (!empty($dataHandler->cmdmap) && array_key_exists(static::TABLE_TT_CONTENT, $dataHandler->cmdmap)) {
            $freeModeLocalizationEnforcer = GeneralUtility::makeInstance(FreeModeLocalizationEnforcer::class);
            $dataHandler->cmdmap = $freeModeLocalizationEnforcer->getProcessedCmd($dataHandler->cmdmap);
        }
    }
}