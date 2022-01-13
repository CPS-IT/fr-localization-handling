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

namespace Fr\LocalizationHandling\Service;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FreeModeLocalizationEnforcer
{
    private const TABLE_TT_CONTENT = 'tt_content';
    private const LOCALIZE_CMD_KEY = 'localize';
    private const COPY_TO_LANGUAGE_CMD_KEY = 'copyToLanguage';

    public bool $cmdUpdated = false;

    public function getProcessedCmd(array $cmd): array
    {
        $this->cmdUpdated = false;
        foreach ($cmd as $table => $incomingCmdArray) {
            foreach ($incomingCmdArray as $recordUid => $recordCmd) {
                $singleCmd = [$table => [$recordUid => $recordCmd]];
                if ($this->shouldProcessSingleCmd($singleCmd)) {
                    $this->cmdUpdated = true;
                    $cmd[static::TABLE_TT_CONTENT][$recordUid][static::COPY_TO_LANGUAGE_CMD_KEY] =
                        (int)$cmd[static::TABLE_TT_CONTENT][$recordUid][static::LOCALIZE_CMD_KEY];
                    unset($cmd[static::TABLE_TT_CONTENT][$recordUid][static::LOCALIZE_CMD_KEY]);
                }
            }
        }

        return $cmd;
    }

    public function getRedirectFromReturnUrl(string $redirect = ''): string
    {
        if (!empty($redirect)) {
            $cRedirect = GeneralUtility::explodeUrl2Array($redirect);
            if (!empty($cRedirect['returnUrl'])) {
                return urldecode($cRedirect['returnUrl']);
            }
        }

        return $redirect;
    }

    protected function shouldProcessSingleCmd($cmd): bool
    {
        if (!isset($cmd[static::TABLE_TT_CONTENT])) {
            return false;
        }

        $recordUid = array_key_first($cmd[static::TABLE_TT_CONTENT]);

        if (!array_key_exists(static::LOCALIZE_CMD_KEY, $cmd[static::TABLE_TT_CONTENT][$recordUid])) {
            return false;
        }

        if (!$this->checkTsConfigConf($recordUid)) {
            return false;
        }

        return true;
    }

    protected function checkTsConfigConf(int $recordUid): bool
    {
        if (!empty($content = BackendUtility::getRecord(static::TABLE_TT_CONTENT, $recordUid, 'uid, pid'))) {
            $tsConfig = BackendUtility::getPagesTSconfig($content['pid']);
            if ((int)$tsConfig['mod.']['web_layout.']['localization.']['enableCopy'] !== 0
                && (int)$tsConfig['mod.']['web_layout.']['localization.']['enableTranslate'] == 0
            ) {
                return true;
            }
        }
        return false;
    }
}