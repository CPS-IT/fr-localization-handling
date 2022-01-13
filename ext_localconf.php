<?php
defined('TYPO3_MODE') or die();

(function () {
    // DataHandler hook
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass'][1642071814] =
        Fr\LocalizationHandling\Hooks\DataHandlerFreeModeLocalizationEnforcerHook::class;

})();
