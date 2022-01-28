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

namespace Fr\LocalizationHandling\Controller;

use Fr\LocalizationHandling\Service\FreeModeLocalizationEnforcer;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class SimpleDataHandlerController extends \TYPO3\CMS\Backend\Controller\SimpleDataHandlerController
{
    protected function init(ServerRequestInterface $request): void
    {
        parent::init($request);

        if ($this->cmd !== null) {
            $freeModeLocalizationEnforcer = GeneralUtility::makeInstance(FreeModeLocalizationEnforcer::class);
            $this->cmd = $freeModeLocalizationEnforcer->getProcessedCmd($this->cmd);
            if ($freeModeLocalizationEnforcer->cmdUpdated === true) {
                $this->redirect = $freeModeLocalizationEnforcer->getRedirectFromReturnUrl($this->redirect);
            }
        }
    }
}